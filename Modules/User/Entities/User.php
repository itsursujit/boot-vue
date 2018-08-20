<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Site\Entities\Site;
use Modules\User\Services\UserPermission;

class User extends Model
{
    //use UserPermission;

    protected $fillable = [];

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'users_sites');
    }
}
