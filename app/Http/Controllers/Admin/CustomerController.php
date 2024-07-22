<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getCustomer();
        $data['header_title'] = 'Customer';
        return view('admin.customer.list', $data);
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect()->back()->with('success', 'Customer deleted successfully !');
    }
}
