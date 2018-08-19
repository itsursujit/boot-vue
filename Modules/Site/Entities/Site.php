<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Site extends Model
{
    protected $fillable = [];

    public $owner;

    public $meta;

    public function owners()
    {
        return $this->belongsToMany(User::class, 'users_sites', 'site_id', 'id');
    }

    public function metas()
    {

    }

    public function owner()
    {
        $this->owner = $this->owners()->first();
        return $this->owner;
    }
}
