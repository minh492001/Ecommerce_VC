<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ShippingCharge::getRecord();
        $data['header_title'] = 'Shipping Charges';
        return view('admin.shipping_charges.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Shipping Charges';
        return view('admin.shipping_charges.add', $data);
    }

    public function insert(Request $request)
    {
        $shipping_charge = new ShippingCharge;
        $shipping_charge->name = trim($request->name);
        $shipping_charge->price = trim($request->price);
        $shipping_charge->status = trim($request->status);
        $shipping_charge->save();

        return redirect('admin/shipping_charges/list')->with('success', 'Shipping Charge added successfully !');
    }

    public function edit($id)
    {
        $data['getRecord'] = ShippingCharge::getSingle($id);
        $data['header_title'] = 'Edit Shipping Charges';
        return view('admin.shipping_charges.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $shipping_charge = ShippingCharge::getSingle($id);
        $shipping_charge->name = trim($request->name);
        $shipping_charge->price = trim($request->price);
        $shipping_charge->status = trim($request->status);
        $shipping_charge->save();

        return redirect('admin/shipping_charges/list')->with('success', 'Discount Code updated successfully !');
    }

    public function delete($id)
    {
        $shipping_charge = ShippingCharge::getSingle($id);
        $shipping_charge->delete();
        return redirect()->back()->with('success', 'Shipping Charge deleted successfully !');
    }
}
