<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

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

            if(!empty(Request::get('sub_category_id'))) {
               $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
                $sub_category_id_array = explode(',', $sub_category_id);
                $product = $product->whereIn('product.sub_category_id', $sub_category_id_array);
            } else {
                if(!empty(Request::get('old_category_id'))) {
                    $product = $product->where('product.category_id', '=', Request::get('old_category_id'));
                }

                if(!empty(Request::get('old_sub_category_id'))) {
                    $product = $product->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
                }
            }

            if(!empty(Request::get('color_id'))) {
                $color_id = rtrim(Request::get('color_id'), ',');
                $color_id_array = explode(',', $color_id);
                $product = $product->join('product_color', 'product_color.product_id', '=', 'product.id');
                $product = $product->whereIn('product_color.color_id', $color_id_array);
            }

            if(!empty(Request::get('brand_id'))) {
                $brand_id = rtrim(Request::get('brand_id'), ',');
                $brand_id_array = explode(',', $brand_id);
                $product = $product->whereIn('product.brand_id', $brand_id_array);
            }

            if(!empty(Request::get('start_price')) && !empty(Request::get('end_price'))) {
                $start_price = str_replace('$', '', Request::get('start_price'));
                $end_price = str_replace('$', '', Request::get('end_price'));
                $product = $product->where('product.price', '>=', $start_price);
                $product = $product->where('product.price', '<=', $end_price);
            }

            if (!empty(Request::get('search'))) {
                $product = $product->where('product.title', 'like', '%'.Request::get('search').'%');
            }

            $product = $product->where('product.status', '=', 0)
                ->groupBy('product.id')
                ->orderBy('product.id', 'DESC')
                ->paginate(3);

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

//    Get Product Slug
    static public function getSingleSlug($slug)
    {
        return Product::where('slug', '=', $slug)
            ->where('product.status', '=', 0)
            ->first();
    }

    static public function getRelatedProduct($product_id, $sub_category_id)
    {
        $product = Product::select('product.*', 'users.name as created_by_name', 'category.name as category_name', 'category.slug as category_slug', 'sub_category.name as sub_category_name', 'sub_category.slug as sub_category_slug')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->where('product.id', '!=', $product_id)
            ->where('product.sub_category_id', '=', $sub_category_id)
            ->where('product.status', '=', 0)
            ->groupBy('product.id')
            ->orderBy('product.id', 'DESC')
            ->limit(10)
            ->get();

        return $product;
    }

//    Eloquent ORM to show the relationship between product and category
    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

//    Eloquent ORM to show the relationship between product and sub_category
    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
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
