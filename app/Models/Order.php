<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

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
        $return = self::select('orders.*');
        if (!empty(Request::get('id'))) {
            $return = self::where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('company_name'))) {
            $return = self::where('company_name', 'like', '%'.Request::get('company_name').'%');
        }
        if (!empty(Request::get('first_name'))) {
            $return = self::where('first_name', 'like', '%'.Request::get('first_name').'%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = self::where('last_name', 'like', '%'.Request::get('last_name').'%');
        }
        if (!empty(Request::get('email'))) {
            $return = self::where('email', 'like', '%'.Request::get('email').'%');
        }
        if (!empty(Request::get('country'))) {
            $return = self::where('country', 'like', '%'.Request::get('country').'%');
        }
        if (!empty(Request::get('state'))) {
            $return = self::where('state', 'like', '%'.Request::get('state').'%');
        }
        if (!empty(Request::get('city'))) {
            $return = self::where('city', 'like', '%'.Request::get('city').'%');
        }
        if (!empty(Request::get('phone'))) {
            $return = self::where('phone', 'like', '%'.Request::get('phone').'%');
        }
        if (!empty(Request::get('postcode'))) {
            $return = self::where('postcode', 'like', '%'.Request::get('postcode').'%');
        }
        if (!empty(Request::get('from_date')) && empty(Request::get('to_date'))) {
            $return = self::whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (empty(Request::get('from_date')) && !empty(Request::get('to_date'))) {
            $return = self::whereDate('created_at', '<=', Request::get('to_date'));
        }
        if (!empty(Request::get('from_date')) && !empty(Request::get('to_date'))) {
            $return = self::whereDate('created_at', '>=', Request::get('from_date'))
                ->whereDate('created_at', '<=', Request::get('to_date'));
        }

        $return = $return->where('is_payment', '=', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return $return;
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
