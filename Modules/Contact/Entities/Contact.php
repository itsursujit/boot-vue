<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Address\Entities\Address;

class Contact extends Model
{
    protected $fillable = [
        "first_name",
        "middle_name",
        "last_name",
        "company_name",
        "phone",
        "mobile",
        "email",
        "website",
        "fax",
        "status"
    ];

    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }
}
