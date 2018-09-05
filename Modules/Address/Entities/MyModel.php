<?php namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model as OriginalModel;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class MyModel extends OriginalModel
{
    use SoftDeletes;
    /**
     * Overrides the default Eloquent query builder
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}