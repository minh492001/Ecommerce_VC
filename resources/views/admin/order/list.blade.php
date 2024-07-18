@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders List (Total: {{ $getRecord->total() }})</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts._message')
                        <form method="get">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Orders Search </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ID:</label>
                                                <input type="text" placeholder="ID" name="id" class="form-control" value="{{ Request::get('id') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Company Name:</label>
                                                <input type="text" placeholder="Company Name" name="company_name" class="form-control" value="{{ Request::get('company_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>First Name:</label>
                                                <input type="text" placeholder="First Name" name="first_name" class="form-control" value="{{ Request::get('first_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Last Name:</label>
                                                <input type="text" placeholder="Last Name" name="last_name" class="form-control" value="{{ Request::get('last_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input type="text" placeholder="Email" name="email" class="form-control" value="{{ Request::get('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Country:</label>
                                                <input type="text" placeholder="Country" name="country" class="form-control" value="{{ Request::get('country') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>State:</label>
                                                <input type="text" placeholder="State" name="state" class="form-control" value="{{ Request::get('state') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>City:</label>
                                                <input type="text" placeholder="City" name="city" class="form-control" value="{{ Request::get('city') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Phone:</label>
                                                <input type="text" placeholder="Phone" name="phone" class="form-control" value="{{ Request::get('phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Postcode:</label>
                                                <input type="text" placeholder="Postcode" name="postcode" class="form-control" value="{{ Request::get('postcode') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>From: </label>
                                                <input type="date" style="padding: 6px" name="from_date" class="form-control" value="{{ Request::get('from_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>To:</label>
                                                <input type="date" style="padding: 6px" name="to_date" class="form-control" value="{{ Request::get('to_date') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{ url('admin/orders/list') }}" class="btn btn-primary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders List</h3>
                            </div>
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Postcode</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Discount Code</th>
                                        <th>Discount Amount ($)</th>
                                        <th>Shipping Amount ($)</th>
                                        <th>Total Amount ($)</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}.</td>
                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->company_name }}</td>
                                            <td>{{ $value->country }}</td>
                                            <td>{{ $value->address_one }} <br /> {{ $value->address_two }}</td>
                                            <td>{{ $value->city }}</td>
                                            <td>{{ $value->state }}</td>
                                            <td>{{ $value->postcode }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->discount_code }}</td>
                                            <td>{{ number_format($value->discount_amount, 2) }}</td>
                                            <td>{{ number_format($value->shipping_amount, 2) }}</td>
                                            <td>{{ number_format($value->total_amount, 2) }}</td>
                                            <td style="text-transform: capitalize">{{ $value->payment_method }}</td>
                                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/orders/detail/'.$value->id ) }}" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
                                    {!! $getRecord->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
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

