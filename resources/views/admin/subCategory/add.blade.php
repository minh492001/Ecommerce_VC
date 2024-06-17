@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Sub Category</h1>
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
                                        <label for="category_id">Category Name <span style="color: red">*</span></label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            <option value="">Select</option>
                                            @foreach($getCategory as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Sub Category Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="name" required value="{{ old('name') }}" name="name" placeholder="Sub Category Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="slug" required value="{{ old('slug') }}" name="slug" placeholder="Slug Ex. URL">
                                        <div style="color:red">{{ $errors->first('slug') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="meta_title" required value="{{ old('meta_title') }}" name="meta_title" placeholder="Meta title">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" placeholder="Meta description" id="meta_description" name="meta_description"> {{ old('meta_description') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" value="{{ old('meta_keywords') }}" name="meta_keywords" placeholder="Meta keywords">
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

