<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubCategory::getRecord();
        $data['header_title'] = 'Sub Category';
        return view('admin.subCategory.list', $data);
    }

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

    public function edit($id)
    {
        $data['getCategory'] = Category::getRecord();
        $data['getRecord'] = SubCategory::getSingle($id);
        $data['header_title'] = 'Edit Sub Category';
        return view('admin.subCategory.edit', $data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'slug' => 'required|unique:sub_category,slug,'.$id
        ]);

        $subCategory = SubCategory::getSingle($id);
        $subCategory->category_id = trim($request->category_id);
        $subCategory->name = trim($request->name);
        $subCategory->slug = trim($request->slug);
        $subCategory->status = trim($request->status);
        $subCategory->meta_title = trim($request->meta_title);
        $subCategory->meta_description = trim($request->meta_description);
        $subCategory->meta_keywords = trim($request->meta_keywords);
        $subCategory->save();

        return redirect('admin/sub_category/list')->with('success', 'Sub Category updated successfully !');
    }

    public function delete($id)
    {
        $category = SubCategory::getSingle($id);
        $category->delete();
        return redirect()->back()->with('success', 'Sub Category deleted successfully !');
    }
}
