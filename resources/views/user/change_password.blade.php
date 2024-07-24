@extends('layouts.app')
@section('style')

@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ url('assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">My Account<span>Change Password</span></h1>
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
                                    <label>Old Password <span style="color: red">*</span></label>
                                    <input type="password" name="old_password" class="form-control" required>

                                    <label>New Password <span style="color: red">*</span></label>
                                    <input type="password" name="password" class="form-control" required>

                                    <label>Confirm Password <span style="color: red">*</span></label>
                                    <input type="password" name="confirm_password" class="form-control" required>

                                    <button type="submit" style="width: 180px" class="btn btn-outline-primary-2 btn-order btn-block">Update Password</button>
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
