<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoiceMail;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCharge;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\DiscountCode;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;

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

    public function place_order(Request $request)
    {
        $validate = 0;
        $message = '';

        // Check if Login or not
        if (!empty(Auth::check())) {
            $user_id = Auth::user()->id;
        } else {
            // Check Email Exist or Not
            if (!empty($request->is_create)) {
                $checkEmail = User::checkEmail($request->email);
                if (!empty($checkEmail)) {
                    $message = "Email Already Exist !";
                    $validate = 1;
                } else {
                    // Create User
                    $user = new User;
                    $user->name = trim($request->first_name);
                    $user->email = trim($request->email);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    $user_id = $user->id;
                }
            } else {
                $user_id = '';
            }
        }

        // If create account success then create Order for new account
        if (empty($validate)) {
            $getShipping = ShippingCharge::getSingle($request->shipping);
            $payable_total = Cart::getSubTotal();
            $discount_amount = 0;
            $discount_code = '';

            // Calculate Total Price
            if (!empty($request->discount_code)) {
                $getDiscount = DiscountCode::checkDiscount($request->discount_code);
                if (!empty($getDiscount)) {
                    $discount_code = $request->discount_code;
                    if ($getDiscount->type == 'Amount') {
                        $discount_amount = $getDiscount->percent_amount;
                        $payable_total = $payable_total - $discount_amount;
                    } else {
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total = $payable_total - $discount_amount;
                    }
                }
            }
            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $total_amount = $payable_total + $shipping_amount;

            // Create Order
            $order = new Order;
            if (!empty($user_id)) {
                $order->user_id = trim($user_id);
            }
            $order->order_number = mt_rand(10000000, 99999999);
            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->company_name = trim($request->company_name);
            $order->country = trim($request->country);
            $order->address_one = trim($request->address_one);
            $order->address_two = trim($request->address_two);
            $order->city = trim($request->city);
            $order->state = trim($request->state);
            $order->postcode = trim($request->postcode);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->note = trim($request->note);
            $order->discount_code = trim($discount_code);
            $order->discount_amount = trim($discount_amount);
            $order->shipping_id = trim($request->shipping);
            $order->shipping_amount = trim($shipping_amount);
            $order->total_amount = trim($total_amount);
            $order->payment_method = trim($request->payment_method);
            $order->save();

            foreach(Cart::getContent() as $key => $cart){
                $order_item = new OrderItem;
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart->id;
                $order_item->quantity = $cart->quantity;
                $order_item->price = $cart->price;

                $color_id = $cart->attributes->color_id;
                if (!empty($color_id)) {
                    $getColor = Color::getSingle($color_id);
                    $order_item->color_name = $getColor->name;
                }

                $size_id = $cart->attributes->size_id;
                if (!empty($size_id)) {
                    $getSize = ProductSize::getSingle($size_id);
                    $order_item->size_name = $getSize->name;
                    $order_item->size_amount = $getSize->price;
                }
                $order_item->total_price = $cart->price * $cart->quantity;
                $order_item->save();
            }
            $json['status'] = true;
            $json['message'] = 'Order placed successfully !';
            $json['redirect'] = url('checkout/payment?order_id='.base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }
        echo json_encode($json);
    }

    public function payment(Request $request)
    {
        if (!empty(Cart::getSubTotal()) && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);
            $getOrder = Order::getSingle($order_id);
            if (!empty($getOrder)) {
                if ($getOrder->payment_method == 'cash') {
                    $getOrder->is_payment = 1;
                    $getOrder->save();
                    Cart::clear();

                    return redirect('cart')->with('success', 'Order placed successfully !');
                } elseif ($getOrder->payment_method == 'paypal') {
                    $query = array();
                    $query['business'] = "vipulbusiness1@gmail.com";
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = 'E-commerce_VC';
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $getOrder->id;
                    $query['amount'] = $getOrder->total_amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('checkout');
                    $query['return'] = url('paypal/payment-success');

                    $query_string = http_build_query($query);

                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
//                    header('Location: https://www.paypal.com/cgi-bin/webscr?' . $query_string);
                    exit();
                } elseif ($getOrder->payment_method == 'stripe') {
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $final_price = $getOrder->total_amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => $getOrder->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => 'E-commerce_VC',
                                ],
                                'unit_amount' => intval($final_price),
                            ],
                            'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('stripe/payment-success'),
                        'cancel_url' => url('checkout'),
                    ]);

                    $getOrder->stripe_session_id = $session['id'];
                    $getOrder->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublicKey'] = env('STRIPE_KEY');

                    return view('payment.stripe_charge', $data);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function paypal_success(Request $request)
    {
        if (!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed') {
            $getOrder = Order::getSingle($request->item_number);
            if (!empty($getOrder)){
                $getOrder->is_payment = 1;
                $getOrder->transaction_id = $request->tx;
                $getOrder->payment_data = json_encode($request->all());
                $getOrder->save();

                Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                Cart::clear();

                return redirect('cart')->with('success', 'Order placed successfully !');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function stripe_success(Request $request)
    {
        $trans_id = Session::get('stripe_session_id');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $getData = \Stripe\Checkout\Session::retrieve($trans_id);

        $getOrder = Order::where('stripe_session_id', '=', $getData->id)->first();
        if (!empty($getOrder) && !empty($getData->id) && $getData->id == $getOrder->stripe_session_id) {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getData->id;
            $getOrder->payment_data = json_encode($getData);
            $getOrder->save();

            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            Cart::clear();

            return redirect('cart')->with('success', 'Order placed successfully !');
        } else {
            return redirect('cart')->with('error', 'Error ! Please try again .');
        }
    }
}
