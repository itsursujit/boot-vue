<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Contact\Traits\HasContact;

class Organizer extends Model
{
    use HasContact;

    protected $fillable = [];
}
