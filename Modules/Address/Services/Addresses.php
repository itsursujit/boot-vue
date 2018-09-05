<?php namespace Modules\Address\Services;
use Illuminate\Support\Facades\Facade;

/**
 * File Addresses
 *
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Modules\Address\Services
 * @subpackage
 * @author     Sujit Baniya <sujit@kvsocial.com>
 * @copyright  2018 Kyvio.com. All rights reserved.
 */
class Addresses extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'addresses';
    }
}