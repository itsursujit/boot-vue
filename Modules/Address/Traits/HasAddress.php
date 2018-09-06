<?php
/**
 * Created by IntelliJ IDEA.
 * User: spbaniya
 * Date: 8/29/18
 * Time: 10:09 AM
 */

namespace Modules\Address\Traits;


use Illuminate\Support\Facades\DB;
use Modules\Address\Entities\Address;

trait HasAddress
{
    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    public static function near($latitude, $longitude, $distanceInKM = 25)
    {
        return static::with('addresses')->whereHas('addresses', function($query) use($latitude, $longitude, $distanceInKM) {
            return $query->select(DB::raw('*, ( 6371 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                         ->having('distance', '<', $distanceInKM)
                         ->orderBy('distance');
        })->get();
    }
}
