<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductSize;
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
                '$color_id' => $color_id,
            ]
        ]);

        return redirect()->back();
    }

    public function cart(Request $request)
    {
        dd(Cart::getContent());
    }
}
