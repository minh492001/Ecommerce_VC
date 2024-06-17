<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Brand::getRecord();
        $data['header_title'] = 'Brand';
        return view('admin.brand.list', $data);
    }

}
