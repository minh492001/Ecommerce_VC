@extends('admin.layouts.app')
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Order Detail</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>ID : <span style="font-weight: normal">{{ $getRecord->id }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Transaction ID : <span style="font-weight: normal">{{ $getRecord->transaction_id }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Name : <span style="font-weight: normal">{{ $getRecord->first_name }} {{ $getRecord->last_name }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Company Name : <span style="font-weight: normal">{{ $getRecord->company_name }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Country : <span style="font-weight: normal">{{ $getRecord->country }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Address : <span style="font-weight: normal">{{ $getRecord->address_one }} {{ $getRecord->address_two }}</label>
                                </div>

                                <div class="form-group">
                                    <label>City : <span style="font-weight: normal">{{ $getRecord->city }}</label>
                                </div>

                                <div class="form-group">
                                    <label>State : <span style="font-weight: normal">{{ $getRecord->state }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Postcode : <span style="font-weight: normal">{{ $getRecord->postcode }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Phone : <span style="font-weight: normal">{{ $getRecord->phone }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Email : <span style="font-weight: normal">{{ $getRecord->email }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Discount Code : <span style="font-weight: normal">{{ $getRecord->discount_code }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Discount Amount ($) : <span style="font-weight: normal">{{ number_format($getRecord->discount_amount, 2) }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Shipping Name : <span style="font-weight: normal">{{ $getRecord->getShipping->name }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Shipping Amount ($) : <span style="font-weight: normal">{{ number_format($getRecord->shipping_amount, 2) }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Total Amount ($) : <span style="font-weight: normal">{{ number_format($getRecord->total_amount, 2) }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label style="text-transform: capitalize">Payment Method : <span style="font-weight: normal">{{ $getRecord->payment_method }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Status :
                                        @if($getRecord->status == 0)
                                            Pending
                                        @elseif($getRecord->status == 1)
                                            In Progress
                                        @elseif($getRecord->status == 2)
                                            Delivered
                                        @elseif($getRecord->status == 3)
                                            Completed
                                        @elseif($getRecord->status == 4)
                                            Cancelled
                                        @endif
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Notes : <span style="font-weight: normal">{{ $getRecord->note }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Created Date : <span style="font-weight: normal">{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</span></label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product Detail</h3>
                            </div>
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Size Amount ($)</th>
                                        <th>Total Amount ($)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord->getItem as $item)
                                            @php
                                                $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id)
                                            @endphp
                                            <tr>
                                                <td>
                                                    <img style="width: 100px; height: 100px" src="{{ $getProductImage->getImage() }}">
                                                </td>

                                                <td>
                                                    <a target="_blank" href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->color_name }}</td>
                                                <td>{{ $item->size_name }}</td>
                                                <td>${{ number_format($item->size_amount, 2) }}</td>
                                                <td>${{ number_format($item->total_price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')

@endsection

