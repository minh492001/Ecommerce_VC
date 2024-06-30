<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getSlug($slug, $subslug = '')
    {
        $getCategory = Category::getSingleSlug($slug);

        $getSubCategory = SubCategory::getSingleSlug($subslug);

        if (!empty($getCategory) && !empty($getSubCategory)) {
            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;
            return view('product.list', $data);
        }
        else if (!empty($getCategory)) {
            $data['getCategory'] = $getCategory;
            return view('product.list', $data);
        } else {
            abort(404);
        }
    }
}
