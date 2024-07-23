@extends('layouts.app')
@section('style')
    <style type="text/css">
        .box-btn {
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ url('assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">My Account<span>Dashboard</span></h1>
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
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">{{ $totalOrders }}</div>
                                            <div style="font-size: 16px">Total Orders</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">{{ $todayOrders }}</div>
                                            <div style="font-size: 16px">Today Orders</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">${{ number_format($totalAmount, 2) }}</div>
                                            <div style="font-size: 16px">Total Amount</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">${{ number_format($todayAmount, 2) }}</div>
                                            <div style="font-size: 16px">Today Amount</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">{{ $totalPending }}</div>
                                            <div style="font-size: 16px">Pending Orders</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">{{ $totalInProgress }}</div>
                                            <div style="font-size: 16px">In Progress Orders</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">{{ $totalCompleted }}</div>
                                            <div style="font-size: 16px">Completed Orders</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold">{{ $totalCancelled }}</div>
                                            <div style="font-size: 16px">Cancelled Orders</div>
                                        </div>
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
