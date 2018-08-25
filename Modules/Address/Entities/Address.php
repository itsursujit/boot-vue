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



    /**
     * Get all of the videos that are assigned this tag.
     */
    public function contacts()
    {
        return $this->morphedByMany(Contact::class, 'addressable');
    }
}
