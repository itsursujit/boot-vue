<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Contact\Traits\HasContact;
use Modules\Site\Entities\Site;
use Modules\User\Services\UserPermission;

class User extends Model
{
    use HasContact;
    //use UserPermission;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'users_sites');
    }
}
