<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function add()
    {
        $data['getCategory'] = Category::getRecord();
        $data['header_title'] = 'Add Sub Category';
        return view('admin.subCategory.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:sub_category',
        ]);

        $subCategory = new SubCategory;
        $subCategory->category_id = trim($request->category_id);
        $subCategory->name = trim($request->name);
        $subCategory->slug = trim($request->slug);
        $subCategory->status = trim($request->status);
        $subCategory->meta_title = trim($request->meta_title);
        $subCategory->meta_description = trim($request->meta_description);
        $subCategory->meta_keywords = trim($request->meta_keywords);
        $subCategory->created_by = Auth::user()->id;
        $subCategory->save();

        return redirect('admin/sub_category/list')->with('success', 'Sub Category added successfully !');
    }

}
