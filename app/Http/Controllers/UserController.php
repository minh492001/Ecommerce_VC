<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $data['meta_title'] = 'Dashboard';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['totalOrders'] = Order::getTotalOrder(Auth::user()->id);
        $data['todayOrders'] = Order::getTodayOrder(Auth::user()->id);
        $data['totalAmount'] = Order::getTotalAmount(Auth::user()->id);
        $data['todayAmount'] = Order::getTodayAmount(Auth::user()->id);

        $data['totalPending'] = Order::getTotalStatus(Auth::user()->id, 0);
        $data['totalInProgress'] = Order::getTotalStatus(Auth::user()->id, 1);
        $data['totalCompleted'] = Order::getTotalStatus(Auth::user()->id, 3);
        $data['totalCancelled'] = Order::getTotalStatus(Auth::user()->id, 4);

        return view('user.dashboard', $data);
    }

    public function orders()
    {
        $data['meta_title'] = 'Orders';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['getOrders'] = Order::getRecordCustomer(Auth::user()->id);

        return view('user.orders', $data);
    }

    public function orders_detail($id)
    {
        $data['getOrderDetail'] = Order::getSingleCustomer(Auth::user()->id, $id);
        if (!empty($data['getOrderDetail'])) {
            $data['meta_title'] = 'Orders Detail';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';

            return view('user.orders_detail', $data);
        } else {
            abort(404);
        }
    }

    public function edit_profile()
    {
        $data['meta_title'] = 'Edit Profile';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getProfile'] = User::getSingle(Auth::user()->id);

        return view('user.edit_profile', $data);
    }

    public function update_profile(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        $user->name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->company_name = trim($request->company_name);
        $user->country = trim($request->country);
        $user->address_one = trim($request->address_one);
        $user->address_two = trim($request->address_two);
        $user->city = trim($request->city);
        $user->state = trim($request->state);
        $user->postcode = trim($request->postcode);
        $user->phone = trim($request->phone);
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function change_password()
    {
        $data['meta_title'] = 'Change Password';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('user.change_password', $data);
    }
}
