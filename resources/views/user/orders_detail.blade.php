@extends('layouts.app')
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ url('assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">My Account<span>Order Details</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        @include('user.sidebar')
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="">
                                    <div class="form-group">
                                        <label>Order Numbers : <span style="font-weight: bold">{{ $getOrderDetail->order_number }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Name : <span style="font-weight: bold">{{ $getOrderDetail->first_name }} {{ $getOrderDetail->last_name }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label>Company Name : <span style="font-weight: bold">{{ $getOrderDetail->company_name }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label>Country : <span style="font-weight: bold">{{ $getOrderDetail->country }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label>Address : <span style="font-weight: bold">{{ $getOrderDetail->address_one }} {{ $getOrderDetail->address_two }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label>City : <span style="font-weight: bold">{{ $getOrderDetail->city }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label>State : <span style="font-weight: bold">{{ $getOrderDetail->state }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Postcode : <span style="font-weight: bold">{{ $getOrderDetail->postcode }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone : <span style="font-weight: bold">{{ $getOrderDetail->phone }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Email : <span style="font-weight: bold">{{ $getOrderDetail->email }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Discount Code : <span style="font-weight: bold">{{ $getOrderDetail->discount_code }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Discount Amount ($) : <span style="font-weight: bold">${{ number_format($getOrderDetail->discount_amount, 2) }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Shipping Name : <span style="font-weight: bold">{{ $getOrderDetail->getShipping->name }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Shipping Amount ($) : <span style="font-weight: bold">${{ number_format($getOrderDetail->shipping_amount, 2) }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Total Amount ($) : <span style="font-weight: bold">${{ number_format($getOrderDetail->total_amount, 2) }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label style="text-transform: capitalize">Payment Method : <span style="font-weight: bold">{{ $getOrderDetail->payment_method }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Status : <b>
                                            @if($getOrderDetail->status == 0)
                                                Pending
                                            @elseif($getOrderDetail->status == 1)
                                                In Progress
                                            @elseif($getOrderDetail->status == 2)
                                                Delivered
                                            @elseif($getOrderDetail->status == 3)
                                                Completed
                                            @elseif($getOrderDetail->status == 4)
                                                Cancelled
                                            @endif
                                            </b>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Notes : <span style="font-weight: bold">{{ $getOrderDetail->note }}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Created Date : <span style="font-weight: bold">{{ date('d-m-Y h:i A', strtotime($getOrderDetail->created_at)) }}</span></label>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" style="margin-top: 20px">
                                        <h3 class="card-title">Product Detail</h3>
                                    </div>
                                    <div class="card-body p-0" style="overflow: auto">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Qty</th>
                                                <th>Price ($)</th>
                                                <th>Total Price ($)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($getOrderDetail->getItem as $item)
                                                @php
                                                    $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id)
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <img style="width: 100px; height: 100px" src="{{ $getProductImage->getImage() }}">
                                                    </td>

                                                    <td>
                                                        <a target="_blank" href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                                        <br>
                                                        {{ $item->color_name }} <br />
                                                        {{ $item->size_name }} : ${{ number_format($item->size_amount, 2) }} <br/>
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>${{ number_format($item->total_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection

@section('script')

@endsection
