<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $table = 'discount_code';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('discount_code.*')
            ->orderBy('discount_code.id', 'desc')
            ->paginate(10);
    }

    static public function checkDiscount($discount_code)
    {
        return self::select('discount_code.*')
            ->where('discount_code.status', '=', 0)
            ->where('discount_code.name', '=', $discount_code)
            ->where('discount_code.expire_date', '>=', date('Y-m-d'))
            ->first();
    }
}
