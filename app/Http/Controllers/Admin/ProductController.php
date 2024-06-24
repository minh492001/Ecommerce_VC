<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Product::getRecord();
        $data['header_title'] = 'Product';
        return view('admin.product.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Product';
        return view('admin.product.add', $data);
    }

    public function insert(Request $request)
    {
        $title = trim($request->title);
        $product = new Product();
        $product->title = $title;
        $product->created_by = Auth::user()->id;
        $product->save();

        $slug = Str::slug($title, "-");

        $checkSlug = Product::checkSlug($slug);
        if (empty($checkSlug)) {
            $product->slug = $slug;
            $product->save();
        } else {
            $new_slug = $slug."-".$product->id;
            $product->slug = $new_slug;
            $product->save();
        }

        return redirect('admin/product/edit/'.$product->id);
    }

    public function edit($id)
    {
        $product = Product::getSingle($id);
        if (!empty($product)) {
            $data['getCategory'] = Category::getRecordActive();
            $data['getBrand'] = Brand::getRecordActive();
            $data['getColor'] = Color::getRecordActive();
            $data['product'] = $product;
            $data['getSubCategory'] = SubCategory::getRecordSubCategory($product->category_id);
            $data['header_title'] = 'Edit Product';
            return view('admin.product.edit', $data);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::getSingle($id);
        if (!empty($product)) {
            $product->title = trim($request->title);
            $product->sku = trim($request->sku);
            $product->category_id = trim($request->category_id);
            $product->sub_category_id = trim($request->sub_category_id);
            $product->brand_id = trim($request->brand_id);
            $product->price = trim($request->price);
            $product->old_price = trim($request->old_price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->additional_information = trim($request->additional_information);
            $product->shipping_returns = trim($request->shipping_returns);
            $product->status = trim($request->status);
            $product->save();

            ProductColor::DeleteRecord($product->id);

            if (!empty($request->color_id)) {
                foreach ($request->color_id as $color_id) {
                    $color = new ProductColor;
                    $color->color_id = $color_id;
                    $color->product_id = $product->id;
                    $color->save();
                }
            }

            return redirect()->back()->with('success', 'Product updated successfully');
        } else {
            abort(404);
        }
        dd($request->all());
    }
}
