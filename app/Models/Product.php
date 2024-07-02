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

    static public function getProduct($category_id = '', $subCategory_id = '')
    {
        $product = Product::select('product.*', 'users.name as created_by_name', 'category.name as category_name', 'category.slug as category_slug', 'sub_category.name as sub_category_name', 'sub_category.slug as sub_category_slug')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id');

            if (!empty($category_id)) {
                $product = $product->where('product.category_id', '=', $category_id);
            }

            if (!empty($subCategory_id)) {
                $product = $product->where('product.sub_category_id', '=', $subCategory_id);
            }

            $product = $product->where('product.status', '=', 0)
            ->orderBy('product.id', 'DESC')
            ->paginate(10);

        return $product;
    }

    static public function getImageSingle($product_id) {
        return ProductImage::where('product_id', '=', $product_id)->orderBy('order_by', 'asc')->first();
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
