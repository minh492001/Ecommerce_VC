@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer List : {{ $getRecord->total() }}</h1>
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
                                    <h3 class="card-title">Customer Search </h3>
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
                                                <label>Name: </label>
                                                <input type="text" placeholder="Name" name="name" class="form-control" value="{{ Request::get('name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Email: </label>
                                                <input type="text" placeholder="Email" name="email" class="form-control" value="{{ Request::get('email') }}">
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
                                                <label>To: </label>
                                                <input type="date" style="padding: 6px" name="to_date" class="form-control" value="{{ Request::get('to_date') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{ url('admin/customer/list') }}" class="btn btn-primary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customer List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}.</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/customer/delete/'.$value->id ) }}" class="btn btn-danger">Delete</a>
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

