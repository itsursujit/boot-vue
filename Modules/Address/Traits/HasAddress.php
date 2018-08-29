<?php
/**
 * Created by IntelliJ IDEA.
 * User: spbaniya
 * Date: 8/29/18
 * Time: 10:09 AM
 */

namespace Modules\Address\Traits;


use Modules\Address\Entities\Address;

trait HasAddress
{
    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }
}
