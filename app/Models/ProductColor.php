<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_color';

    static public function DeleteRecord($product_id)
    {
        return self::where('product_id', '=', $product_id)->delete();
    }

    public function getColor()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
