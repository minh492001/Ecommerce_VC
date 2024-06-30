<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategory($slug)
    {
        $getCategory = Category::getSingleSlug($slug);

        if (!empty($getCategory)) {
            $data['getCategory'] = $getCategory;
            return view('product.list', $data);
        } else {
            abort(404);
        }
    }
}
