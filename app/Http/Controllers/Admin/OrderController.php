<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusMail;

class OrderController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Order::getRecord();
        $data['header_title'] = 'Orders';
        return view('admin.order.list', $data);
    }

    public function detail($id)
    {
        $data['getRecord'] = Order::getSingle($id);
        $data['header_title'] = 'Order Detail';
        return view('admin.order.detail', $data);
    }

    public function order_status(Request $request)
    {
        $getOrder = Order::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();

        Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));

        $json['message'] = 'Status updated successfully';
        echo json_encode($json);
    }

}
