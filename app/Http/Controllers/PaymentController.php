<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCharge;
use Cart;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\DiscountCode;
class PaymentController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;
        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSize::getSingle($size_id);

            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => [
                'size_id' => $size_id,
                'color_id' => $color_id,
            ]
        ]);

        return redirect()->back();
    }

    public  function checkout(Request $request)
    {
        $data['meta_title'] = 'Checkout';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getShipping'] = ShippingCharge::getRecordActive();

        return view('payment.checkout', $data);
    }

    public function apply_discount_code(Request $request)
    {
        $getDiscount = DiscountCode::checkDiscount($request->discount_code);
        if (!empty($getDiscount)) {
            $total = Cart::getSubTotal();
            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $discount_amount;
            } else {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }
            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = "Success";
        } else {
            $json['status'] = false;
            $json['discount_amount'] = number_format(0, 2);
            $json['payable_total'] = Cart::getSubTotal();
            $json['message'] = "Discount Code Invalid !";
        }

        echo json_encode($json);
    }

    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('payment.cart', $data);
    }

    public function update_cart(Request $request)
    {
        foreach ($request->cart as $cart) {
            Cart::update($cart['id'], [
                'quantity' => [
                    'relative' => false,
                    'value' => $cart['qty']
                ]
            ]);
        }

        return redirect()->back();
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
}
