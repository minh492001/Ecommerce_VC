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

    public function add()
    {
        $data['header_title'] = 'Add Brand';
        return view('admin.brand.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:brand',
        ]);

        $brand = new Brand;
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->created_by = Auth::user()->id;
        $brand->save();

        return redirect('admin/brand/list')->with('success', 'Brand added successfully !');
    }

    public function edit($id)
    {
        $data['getRecord'] = Brand::getSingle($id);
        $data['header_title'] = 'Edit Brand';
        return view('admin.brand.edit', $data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'slug' => 'required|unique:brand,slug,'.$id,
        ]);

        $brand = Brand::getSingle($id);
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->save();

        return redirect('admin/brand/list')->with('success', 'Brand updated successfully !');
    }
}
