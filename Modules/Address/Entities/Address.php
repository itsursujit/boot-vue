<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Contact\Entities\Contact;
use Modules\Event\Entities\Event;

class Address extends MyModel
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
        return $this->morphTo();
    }

    public static function withAddressable()
    {
        return static::leftJoin('addressables', 'addresses.id', '=', 'address_id')
            ->select(['addresses.*']);
    }

    public static function getAddresses($class)
    {
        if(!class_exists($class))
            return null;

        return $class::with('addresses')->get()->pluck('addresses')->flatten();
    }

    public static function near($latitude, $longitude, $distanceInKM = 25)
    {
        return static::select(DB::raw('*, ( 6371 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                         ->having('distance', '<', $distanceInKM)
                         ->orderBy('distance');
    }
}
