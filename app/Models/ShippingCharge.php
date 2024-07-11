<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;

    protected $table = 'shipping_charges';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('shipping_charges.*')
            ->orderBy('shipping_charges.id', 'DESC')
            ->paginate(5);
    }

    static public function getRecordActive()
    {
        return self::select('shipping_charges.*')
            ->where('shipping_charges.status', '=', 0)
            ->orderBy('shipping_charges.price', 'ASC')
            ->get();
    }
}
