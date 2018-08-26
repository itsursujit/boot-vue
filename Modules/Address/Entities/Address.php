<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Contact\Entities\Contact;

class Address extends Model
{
    protected $fillable = [
        "address_line_1",
        "address_line_2",
        "city",
        "state",
        "zip_code",
        "country",
        "latitude",
        "longitude",
    ];

    public function addressable()
    {
        $this->morphTo();
    }

    public static function getAddressable($class)
    {
        if(!class_exists($class))
            return null;

        return $class::with('addresses')->get()->pluck('addresses')->flatten();
    }
}
