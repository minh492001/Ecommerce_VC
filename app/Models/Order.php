<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getSingle($order_id)
    {
        return self::find($order_id);
    }

    static public function getRecord()
    {
        return self::select('orders.*')
            ->where('is_payment', '=', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getShipping()
    {
        return $this->belongsTo(ShippingCharge::class, 'shipping_id');
    }

    public function getItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
