<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Address\Traits\HasAddress;
use Modules\Product\Traits\HasProduct;

class Event extends Model
{
    use HasAddress, HasProduct;

    protected $fillable = [
        'title', 'slogan', 'description'
    ];
}
