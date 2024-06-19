<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Product::getRecord();
        $data['header_title'] = 'Product';
        return view('admin.product.list', $data);
    }

}
