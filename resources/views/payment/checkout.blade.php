@extends('layouts.app')
@section('style')

@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <form action="" id="SubmitForm" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name <span style="color: red">*</span></label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name <span style="color: red">*</span></label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Company Name (Optional) </label>
                                <input type="text" name="company_name" class="form-control">

                                <label>Country <span style="color: red">*</span></label>
                                <input type="text" name="country" class="form-control" required>

                                <label>Street address <span style="color: red">*</span></label>
                                <input type="text" name="address_one" class="form-control" placeholder="House number and Street name" required>
                                <input type="text" name="address_two" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City <span style="color: red">*</span></label>
                                        <input type="text" name="city" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>State <span style="color: red">*</span></label>
                                        <input type="text" name="state" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP <span style="color: red">*</span></label>
                                        <input type="text" name="postcode" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone <span style="color: red">*</span></label>
                                        <input type="tel" name="phone" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Email address <span style="color: red">*</span></label>
                                <input type="email" name="email" class="form-control" required>

                                @if(empty(Auth::check()))
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_create" class="custom-control-input createAccount" id="checkout-create-acc">
                                    <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                </div><!-- End .custom-checkbox -->

                                <div id="showPassword" style="display: none">
                                    <label>Password <span style="color: red">*</span></label>
                                    <input type="text" id="inputPassword" name="password" class="form-control">
                                </div>
                                @endif

                                <label>Order notes (optional)</label>
                                <textarea class="form-control" name="note" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach(Cart::getContent() as $key => $cart)
                                            @php
                                                $getCartProduct = App\Models\Product::getSingle($cart->id);
                                            @endphp
                                            <tr>
                                                <td><a href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }}</a></td>
                                                <td>${{ number_format($cart->price * $cart->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td colspan="2">
                                                <div class="cart-discount">
                                                    <div class="input-group">
                                                        <input id="getDiscountCode" name="discount_code" type="text" class="form-control" placeholder="coupon code">
                                                        <div class="input-group-append">
                                                            <button id="ApplyDiscount" style="height: 38px" type="button" class="btn btn-outline-primary-2"><i class="icon-long-arrow-right"></i></button>
                                                        </div><!-- .End .input-group-append -->
                                                    </div><!-- End .input-group -->
                                                </div><!-- End .cart-discount -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Discount:</td>
                                            <td>$<span id="getDiscountAmount">0.00</span></td>
                                        </tr>
                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        @foreach($getShipping as $shipping)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" value="{{ $shipping->id }}" id="shipping-{{ $shipping->id }}" name="shipping" data-price="{{ !empty($shipping->price) ? $shipping->price : 0 }}" class="custom-control-input getShippingCharge" required>
                                                    <label class="custom-control-label" for="shipping-{{ $shipping->id }}">{{ $shipping->name }}</label>
                                                </div><!-- End .custom-control -->
                                            </td>
                                            <td>
                                                ${{ number_format($shipping->price, 2) }}
                                            </td>
                                        </tr><!-- End .summary-shipping-row -->
                                        @endforeach

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>$<span id="getPayableTotal">{{ number_format(Cart::getSubTotal(), 2) }}</span></td>
                                        </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->
                                    <input type="hidden" id="getShippingCharge" value="0">
                                    <input type="hidden" id="PayableTotal" value="{{ Cart::getSubTotal() }}">
                                    <div class="accordion-summary" id="accordion-payment">

                                        <div class="custom-control custom-radio">
                                            <input type="radio" value="cash" id="COD" name="payment_method" class="custom-control-input" required>
                                            <label class="custom-control-label" for="COD">Cash on delivery</label>
                                        </div><!-- End .custom-control -->

                                        <div class="custom-control custom-radio" style="margin-top: 0px">
                                            <input type="radio" value="paypal" id="Paypal" name="payment_method" class="custom-control-input" required>
                                            <label class="custom-control-label" for="Paypal">Paypal</label>
                                        </div><!-- End .custom-control -->

                                        <div class="custom-control custom-radio" style="margin-top: 0px">
                                            <input type="radio" value="stripe" id="Credit Card" name="payment_method" class="custom-control-input" required>
                                            <label class="custom-control-label" for="Credit Card">Credit Card (Stripe)</label>
                                        </div><!-- End .custom-control -->
                                        <img src="{{ url('assets/images/payments-summary.png') }}" alt="payments cards">
                                    </div><!-- End .accordion -->

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection

@section('script')
    <script type="text/javascript">
        $('body').delegate('.createAccount', 'change', function () {
            if(this.checked) {
                $('#showPassword').show()
                $('#inputPassword').prop('required', true)
            } else {
                $('#showPassword').hide()
                $('#inputPassword').prop('required', false)
            }
        });

        $('body').delegate('#SubmitForm', 'submit', function (e) {
            e.preventDefault()
            $.ajax({
                type : "POST",
                url : "{{ url('checkout/place_order') }}",
                data : new FormData(this),
                processData : false,
                contentType : false,
                dataType : "json",
                success : function (data) {
                    if(data.status == false) {
                        alert(data.message)
                    } else {
                        window.location.href = data.redirect
                    }
                },
                error : function (data) {

                }
            })
        })

        $('body').delegate('.getShippingCharge', 'change', function () {
            let price = $(this).attr('data-price')
            let total = $('#PayableTotal').val()
            $('#getShippingCharge').val(price)
            let final_total = parseFloat(price) + parseFloat(total)
            $('#getPayableTotal').html(final_total.toFixed(2))
        });

        $('body').delegate('#ApplyDiscount', 'click', function () {
            let discount_code = $('#getDiscountCode').val();

            $.ajax({
                type : "POST",
                url : "{{ url('checkout/apply-discount-code') }}",
                data : {
                    discount_code : discount_code,
                    "_token" : "{{ csrf_token() }}"
                },
                dataType : "json",
                success : function (data) {
                    $('#getDiscountAmount').html(data.discount_amount)
                    let shipping = $('#getShippingCharge').val()
                    let final_total = parseFloat(shipping) + parseFloat(data.payable_total)
                    $('#getPayableTotal').html(final_total.toFixed(2))
                    $('#PayableTotal').val(data.payable_total)

                    if(data.status == false) {
                        alert(data.message)
                    }
                },
                error : function (data) {

                }
            })
        });
    </script>
@endsection
