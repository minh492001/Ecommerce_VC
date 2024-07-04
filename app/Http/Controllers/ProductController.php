<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getSlug($slug, $subslug = '')
    {
        $getCategory = Category::getSingleSlug($slug);
        $getSubCategory = SubCategory::getSingleSlug($subslug);
        $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

        if (!empty($getCategory) && !empty($getSubCategory)) {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;

            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);

            $getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);
            $data['getProduct'] = $getProduct;

            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());
                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            return view('product.list', $data);
        }
        else if (!empty($getCategory)) {
            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);

            $data['getCategory'] = $getCategory;

            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;

            $getProduct = Product::getProduct($getCategory->id);
            $data['getProduct'] = $getProduct;

            // Pagination using AJAX
            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());
                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            return view('product.list', $data);
        } else {
            abort(404);
        }
    }

    public function getFilterProduct(Request $request)
    {
        $getProduct = Product::getProduct();

        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl());
            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }
        $data['page'] = $page;

        return response()->json([
            "status" => true,
            "page" => $page,
            "success" => view("product._list", [
                "getProduct" => $getProduct,
            ])->render(),
        ], 200);
    }
}
