<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const ID = 'id';
    const VENDOR_KEY = 'vendor_id';

    const VENDOR = 'vendor';

    protected $table = 'products';

    public function vendor()
    {
        return $this->belongsTo(
            Vendor::class, self::VENDOR_KEY, Vendor::ID);
    }
}
