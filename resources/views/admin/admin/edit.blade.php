@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Admin</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}" id="name" required name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" id="email" required name="email" placeholder="Enter Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        <p>Change Password if it's necessary</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Status</label>
                                        <select class="form-control" name="status" required>
                                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection

@section('script')

@endsection

