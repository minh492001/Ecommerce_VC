@extends('layouts.app')
@section('style')

@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ url('assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">My Account<span>Edit Profile</span></h1>
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
                                @include('layouts._message')
                                <form action="" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name </label>
                                            <input type="text" name="first_name" value="{{ $getProfile->name }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name </label>
                                            <input type="text" name="last_name" value="{{ $getProfile->last_name }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Email address </label>
                                    <input type="email" name="email" value="{{ $getProfile->email }}" class="form-control" required>

                                    <label>Company Name </label>
                                    <input type="text" name="company_name" value="{{ $getProfile->company_name }}" class="form-control">

                                    <label>Country </label>
                                    <input type="text" name="country" value="{{ $getProfile->country }}" class="form-control" required>

                                    <label>Street address </label>
                                    <input type="text" name="address_one" value="{{ $getProfile->address_one }}" class="form-control" placeholder="House number and Street name" required>
                                    <input type="text" name="address_two" value="{{ $getProfile->address_two }}" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City </label>
                                            <input type="text" name="city" value="{{ $getProfile->city }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>State </label>
                                            <input type="text" name="state" value="{{ $getProfile->state }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP </label>
                                            <input type="text" name="postcode" value="{{ $getProfile->postcode }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Phone </label>
                                            <input type="tel" name="phone" value="{{ $getProfile->phone }}" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <button type="submit" style="width: 100px" class="btn btn-outline-primary-2 btn-order btn-block">Submit</button>
                                </form>
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
