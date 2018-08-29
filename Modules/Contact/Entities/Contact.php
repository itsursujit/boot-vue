<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Address\Entities\Address;
use Modules\Address\Traits\HasAddress;

class Contact extends Model
{
    use HasAddress;

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

    public function contactable()
    {
        $this->morphTo();
    }
}
