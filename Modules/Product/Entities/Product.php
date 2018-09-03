<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'site_id'
    ];
    protected $table = 'productables';

    public function productable()
    {
        $this->morphTo('products');
    }

    public static function getProducts($class)
    {
        if(!class_exists($class))
            return null;

        return $class::with('products')->get()->pluck('products')->flatten();
    }
}
