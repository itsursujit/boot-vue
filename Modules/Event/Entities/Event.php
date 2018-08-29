<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Address\Traits\HasAddress;

class Event extends Model
{
    use HasAddress;

    protected $fillable = [];
}
