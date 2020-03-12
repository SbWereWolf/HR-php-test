<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ID = 'id';
    const STATUS_KEY = 'status';
    const PARTNER_KEY = 'partner_id';
    const POSITIONS = 'positions';

    protected $table = 'orders';

    protected $fillable = [
        'status',
        'client_email',
        'partner_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'delivery_dt',
    ];


    public function partner()
    {
        return $this->belongsTo(
            Partner::class, self::PARTNER_KEY, Partner::ID);
    }

    public function state()
    {
        return $this->belongsTo(Status::class, self::STATUS_KEY, Status::ID);
    }

    public function positions()
    {
        return $this->hasMany(
            OrderProduct::class, OrderProduct::ORDER_KEY, self::ID)
            ->with(OrderProduct::PRODUCT);
    }
}
