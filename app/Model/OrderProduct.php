<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    const ORDER_KEY = 'order_id';
    const PRODUCT_KEY = 'product_id';

    const PRODUCT = 'product';

    protected $table = 'order_products';

    public function product()
    {
        return $this->belongsTo(
            Product::class, self::PRODUCT_KEY, Product::ID);
    }
}
