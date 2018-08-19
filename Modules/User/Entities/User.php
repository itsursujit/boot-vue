<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Site\Entities\Site;

class User extends Model
{
    protected $fillable = [];

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'users_sites', 'user_id', 'id');
    }
}
