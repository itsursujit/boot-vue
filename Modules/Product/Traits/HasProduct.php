<?php namespace Modules\Product\Traits;
use Modules\Product\Entities\Product;

/**
 * File HasProduct
 *
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Modules\Product\Traits
 * @subpackage
 * @author     Sujit Baniya <sujit@kvsocial.com>
 * @copyright  2018 Kyvio.com. All rights reserved.
 */
trait HasProduct
{

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}