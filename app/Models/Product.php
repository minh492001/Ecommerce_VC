<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    static public function getRecord()
    {
        return Product::select('product.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->orderBy('product.id', 'DESC')
            ->paginate(10);
    }

    static public function checkSlug($slug)
    {
        return Product::where("slug", "=", $slug)->count();
    }

    static public function getSingle($id)
    {
        return Product::find($id);
    }

    public function getColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function getSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function getImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
