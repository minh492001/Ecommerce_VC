@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Shipping Charge</h1>
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
                                        <label for="name">Shipping Charge<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="name" required value="{{ old('name') }}" name="name" placeholder="Shipping Charge">
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="price" required value="{{ old('price') }}" name="price" placeholder="Price">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status<span style="color: red">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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

