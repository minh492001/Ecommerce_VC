<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    public function list()
    {
        $data['getRecord'] = DiscountCode::getRecord();
        $data['header_title'] = 'Discount Code';
        return view('admin.discount_code.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Discount Code';
        return view('admin.discount_code.add', $data);
    }

    public function insert(Request $request)
    {
        $discount_code = new DiscountCode;
        $discount_code->name = trim($request->name);
        $discount_code->type = trim($request->type);
        $discount_code->percent_amount = trim($request->percent_amount);
        $discount_code->expire_date = trim($request->expire_date);
        $discount_code->status = trim($request->status);
        $discount_code->save();

        return redirect('admin/discount_code/list')->with('success', 'Discount Code added successfully !');
    }

    public function edit($id)
    {
        $data['getRecord'] = DiscountCode::getSingle($id);
        $data['header_title'] = 'Edit Color';
        return view('admin.discount_code.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $discount_code = DiscountCode::getSingle($id);
        $discount_code->name = trim($request->name);
        $discount_code->type = trim($request->type);
        $discount_code->percent_amount = trim($request->percent_amount);
        $discount_code->expire_date = trim($request->expire_date);
        $discount_code->status = trim($request->status);
        $discount_code->save();

        return redirect('admin/discount_code/list')->with('success', 'Discount Code updated successfully !');
    }

    public function delete($id)
    {
        $discount_code = DiscountCode::getSingle($id);
        $discount_code->delete();
        return redirect()->back()->with('success', 'Discount Code deleted successfully !');
    }
}
