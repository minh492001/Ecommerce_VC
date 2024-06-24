@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Product</h1>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="title" required value="{{ old('title', $product->title ) }}" name="title" placeholder="Enter Title">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sku">SKU <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="sku" required value="{{ old('sku', $product->sku ) }}" name="sku" placeholder="Enter SKU">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category <span style="color: red">*</span></label>
                                                <select class="form-control" id="category" name="category_id">
                                                    <option value="">Select</option>
                                                    @foreach($getCategory as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_category">Sub Category <span style="color: red">*</span></label>
                                                <select class="form-control" id="sub_category" name="sub_category_id">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="brand">Brand <span style="color: red">*</span></label>
                                                <select class="form-control" id="brand" name="brand_id">
                                                    <option value="">Select</option>
                                                    @foreach($getBrand as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Color <span style="color: red">*</span></label>
                                                @foreach($getColor as $color)
                                                <div>
                                                    <label><input type="checkbox" name="color_id[]" value="{{ $color->id }}">{{ $color->name }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price ($) <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="price" required value="" name="price" placeholder="Enter Price">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="old_price">Old Price ($) <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="old_price" required value="" name="sku" placeholder="Old Price">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Size <span style="color: red">*</span></label>
                                                <div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Price ($)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="AppendSize">
                                                            <tr>
                                                                <td><input type="text" name="" placeholder="Name" class="form-control"></td>
                                                                <td><input type="text" name="" placeholder="Price" class="form-control"></td>
                                                                <td style="width: 200px">
                                                                    <button type="button" class="btn btn-primary AddSize">Add</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="short_des">Short Description <span style="color: red">*</span></label>
                                                <textarea class="form-control" id="short_des" name="short_description" placeholder="Short Description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description <span style="color: red">*</span></label>
                                                <textarea class="form-control editor" id="description" name="description" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="info">Additional Information <span style="color: red">*</span></label>
                                                <textarea class="form-control editor" id="info" name="additional_information" placeholder="Additional Information"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="shipping">Shipping Returns <span style="color: red">*</span></label>
                                                <textarea class="form-control editor" id="shipping" name="shipping_returns" placeholder="Shipping Returns"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="status">Status <span style="color: red">*</span></label>
                                                <select class="form-control" name="status" id="status" required>
                                                    <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                                    <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
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
    <script src="https://cdn.tiny.cloud/1/jxcth939yx7b1jm7h09xerf08nydmgo26avhr9n9pklhxbpz/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ url('public/tinyMCE/tinymce-jquery.min.js') }}"></script>
    <script type="text/javascript">

        $('.editor').tinymce({
            height: 500,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | help'
        });

    let i = 1000;
    $('body').delegate('.AddSize', 'click', function () {
        let html = '<tr id="DeleteSize'+i+'">\n\
                        <td>\n\
                            <input type="text" name="" placeholder="Name" class="form-control">\n\
                        </td>\n\
                        <td>\n\
                            <input type="text" name="" placeholder="Price" class="form-control">\n\
                        </td>\n\
                        <td>\n\
                            <button type="button" id="'+i+'" class="btn btn-danger DeleteSize">Delete</button>\n\
                        </td>\n\
                    </tr>';
        i++;
        $('#AppendSize').append(html);
    });

    $('body').delegate('.DeleteSize', 'click', function () {
        let id = $(this).attr('id');
        $('#DeleteSize'+id).remove();
    });

    $('body').delegate('#category', 'change', function (e) {
        let id = $(this).val();

        $.ajax({
            type : "POST",
            url : "{{ url('admin/get_sub_category') }}",
            data : {
                'id' : id,
                '_token' : "{{ csrf_token() }}"
            },
            dataType : "json",
            success : function (data) {
                $('#sub_category').html(data.html);
            },
            error : function (data) {

            }
        });
    });
</script>
@endsection
