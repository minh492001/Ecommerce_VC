@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Color</h1>
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
                                        <label for="name">Color Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="name" required value="{{ old('name', $getRecord->name) }}" name="name" placeholder="Color Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="code">Color Code <span style="color: red">*</span></label>
                                        <input type="color" class="form-control" id="code" required value="{{ old('code', $getRecord->code) }}" name="code" placeholder="Color Code">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
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

