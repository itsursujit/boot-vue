<?php namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Builder as OriginalBuilder;
use Closure;
use Exception;
use Illuminate\Support\Str;

class Builder extends OriginalBuilder
{
    /**
     * Get the "has relation" base query instance.
     *
     * @param  string  $relation
     * @param  string  $morphType
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    protected function getHasRelationQuery($relation, $morphType = null)
    {
        return Relation::noConstraints(function() use ($relation, $morphType)
        {
            $name = $relation;
            $relation = $this->getModel()->$relation();

            if (get_class($relation) === 'Illuminate\Database\Eloquent\Relations\MorphTo') {
                if (!$morphType) {
                    throw new Exception('No morph type(s) specified in `whereHas` method call.');
                }

                $lookAhead = $relation->getParent()->where($name . '_type', '=', $morphType)->withTrashed()->first();
                if (!$lookAhead) {
                    throw new Exception('Either the morph type `'.$morphType.'` specified in the `whereHas` method call is invalid, or the table related to the '.get_class($relation->getParent()).' Eloquent model does not contain a row where the `'.$name . '_type` field is equal to `'.$morphType.'`.');
                }
                $relation = $lookAhead->{$name}();

                $relation = $relation->where($relation->getParent()->getTable() . '.' . $relation->getMorphType(), '=', $morphType);
            };

            return $relation;
        });
    }
    /**
     * Add a relationship count condition to the query.
     *
     * @param  string  $relation
     * @param  string  $operator
     * @param  int     $count
     * @param  string  $boolean
     * @param  \Closure|null  $callback
     * @param  array   $morphTypes
     * @param  bool    $morphCall
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function has($relation, $operator = '>=', $count = 1, $boolean = 'and', Closure $callback = null, $morphTypes = null, $morphCall = false)
    {
        if (strpos($relation, '.') !== false) {
            return $this->hasNested($relation, $operator, $count, $boolean, $callback);
        }
        if (!is_null($morphTypes) && $morphCall === false) {
            return $this->hasMorphed($relation, $operator, $count, $boolean, $callback, $morphTypes);
        }

        $relation = $this->getHasRelationQuery($relation, $morphTypes);
        $query = $relation->getRelationCountQuery($relation->getRelated()->newQuery(), $this);
        if ($callback) {
            call_user_func($callback, $query);
        }
        return $this->addHasWhere($query, $relation, $operator, $count, $boolean);
    }
    /**
     * New method for handling `has` on morphTo relationships.
     *
     * @param  string  $relation
     * @param  string  $operator
     * @param  int     $count
     * @param  string  $boolean
     * @param  \Closure|null  $callback
     * @param  array   $morphTypes
     * @param  bool    $morphCall
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function hasMorphed($relation, $operator = '>=', $count = 1, $boolean = 'and', Closure $callback = null, $morphTypes = null)
    {
        if (!is_array($morphTypes)) {
            $morphTypes = [$morphTypes];
        }

        return $this->where(function ($query) use ($morphTypes, $relation, $operator, $count, $callback) {
            foreach ($morphTypes as $type) {
                $query->has($relation, $operator, $count, 'or', $callback, $type, true);
            }
        }, null, null, $boolean);
    }
    /**
     * Add a relationship count condition to the query.
     *
     * @param  string  $relation
     * @param  string  $boolean
     * @param  \Closure|null  $callback
     * @param  array   $morphTypes
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function doesntHave($relation, $boolean = 'and', Closure $callback = null, $morphTypes = null)
    {
        return $this->has($relation, '<', 1, $boolean, $callback, $morphTypes);
    }

    /**
     * Set the relationships that should be eager loaded.
     *
     * @param  mixed  $relations
     * @return $this
     */
    public function with($relations)
    {
        $eagerLoad = $this->parseWithRelations(is_string($relations) ? func_get_args() : $relations);
        $this->eagerLoad = array_merge($this->eagerLoad, $eagerLoad);

        return $this;
    }

    /**
     * Parse a list of relations into individuals.
     *
     * @param  array  $relations
     * @return array
     */
    protected function parseWithRelations(array $relations)
    {
        $results = [];

        foreach ($relations as $name => $constraints) {
            // If the "relation" value is actually a numeric key, we can assume that no
            // constraints have been specified for the eager load and we'll just put
            // an empty Closure with the loader so that we can treat all the same.
            if (is_numeric($name)) {
                $name = $constraints;

                list($name, $constraints) = Str::contains($name, ':')
                    ? $this->createSelectWithConstraint($name)
                    : [$name, function () {
                        //
                    }];
            }

            // We need to separate out any nested includes. Which allows the developers
            // to load deep relationships using "dots" without stating each level of
            // the relationship with its own key in the array of eager load names.
            $results = $this->addNestedWiths($name, $results);

            $results[$name] = $constraints;
        }

        return $results;
    }


    /**
     * Add a relationship count / exists condition to the query with where clauses.
     *
     * @param  string        $relation
     * @param  \Closure|null $callback
     * @param  string        $operator
     * @param  int           $count
     * @param null           $morphTypes
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function whereHas($relation, Closure $callback = null, $operator = '>=', $count = 1, $morphTypes = null)
    {
        return $this->has($relation, $operator, $count, 'and', $callback, $morphTypes);
    }

    /**
     * Add a relationship count condition to the query with an "or".
     *
     * @param  string  $relation
     * @param  string  $operator
     * @param  int     $count
     * @param  array   $morphTypes
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function orHas($relation, $operator = '>=', $count = 1, $morphTypes = null)
    {
        return $this->has($relation, $operator, $count, 'or', $morphTypes);
    }
    /**
     * Add a relationship count condition to the query with where clauses and an "or".
     *
     * @param  string    $relation
     * @param  \Closure  $callback
     * @param  string    $operator
     * @param  int       $count
     * @param  array     $morphTypes
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function orWhereHas($relation, Closure $callback = null, $operator = '>=', $count = 1, $morphTypes = null)
    {
        return $this->has($relation, $operator, $count, 'or', $callback, $morphTypes);
    }
}