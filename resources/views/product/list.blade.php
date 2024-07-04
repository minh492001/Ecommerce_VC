@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
    <style type="text/css">
        .active-color {
            border: 3px solid #000 !important;
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ url('assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                @if(!empty($getSubCategory))
                    <h1 class="page-title">{{ $getSubCategory->name }}</h1>
                @else
                    <h1 class="page-title">{{ $getCategory->name }}</h1>
                @endif
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:">Shop</a></li>
                    @if(!empty($getSubCategory))
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ url($getCategory->slug) }}">{{ $getCategory->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $getSubCategory->name }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $getCategory->name }}</li>
                    @endif
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>{{ $getProduct->perPage() }} of {{ $getProduct->total() }}</span> Products
                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control ChangeSortBy">
                                            <option value="">Select</option>
                                            <option value="popularity">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div><!-- End .toolbox-sort -->

                            </div><!-- End .toolbox-right -->
                        </div><!-- End .toolbox -->
                    <div id="getProductAjax">
                        @include('product._list')
                    </div>

                    <div style="text-align: center">
                        <a href="javascript:" @if(empty($page)) style="display: none" @endif data-page="{{ $page }}" class="btn btn-primary LoadMore">Load More</a>
                    </div>

                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3 order-lg-first">
                        <form id="FilterForm" method="post" action="">
                            {{ csrf_field() }}
                            <input type="hidden" name="old_sub_category_id" value="{{ !empty($getSubCategory) ? $getSubCategory->id : '' }}">
                            <input type="hidden" name="old_category_id" value="{{ !empty($getCategory) ? $getCategory->id : '' }}">
                            <input type="hidden" name="sub_category_id" id="get_sub_category_id">
                            <input type="hidden" name="brand_id" id="get_brand_id">
                            <input type="hidden" name="color_id" id="get_color_id">
                            <input type="hidden" name="sort_by_id" id="get_sort_by_id">
                            <input type="hidden" name="start_price" id="get_start_price">
                            <input type="hidden" name="end_price" id="get_end_price">
                        </form>
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div><!-- End .widget widget-clean -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach($getSubCategoryFilter as $filter_category)
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ChangeCategory" value="{{ $filter_category->id }}" id="cat-{{ $filter_category->id }}">
                                                    <label class="custom-control-label" for="cat-{{ $filter_category->id }}">{{ $filter_category->name }}</label>
                                                </div><!-- End .custom-checkbox -->
                                                <span class="item-count">{{ $filter_category->TotalProduct() }}</span>
                                            </div><!-- End .filter-item -->
                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        Size
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                                    <label class="custom-control-label" for="size-1">XS</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-2">
                                                    <label class="custom-control-label" for="size-2">S</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked id="size-3">
                                                    <label class="custom-control-label" for="size-3">M</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked id="size-4">
                                                    <label class="custom-control-label" for="size-4">L</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-5">
                                                    <label class="custom-control-label" for="size-5">XL</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-6">
                                                    <label class="custom-control-label" for="size-6">XXL</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                        Color
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-3">
                                    <div class="widget-body">
                                        <div class="filter-colors">
                                            @foreach($getColor as $filter_color)
                                            <a href="javascript:" id="{{ $filter_color->id }}" class="ChangeColor" data-val="0" style="background: {{ $filter_color->code }};"><span class="sr-only">{{ $filter_color->name }}</span></a>
                                            @endforeach
{{--                                            <a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>--}}
                                        </div><!-- End .filter-colors -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach($getBrand as $filter_brand)
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ChangeBrand" value="{{ $filter_brand->id }}" id="brand-{{ $filter_brand->id }}">
                                                    <label class="custom-control-label" for="brand-{{ $filter_brand->id }}">{{ $filter_brand->name }}</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->
                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range:
                                                <span id="filter-price-range"></span>
                                            </div><!-- End .filter-price-text -->

                                            <div id="price-slider"></div><!-- End #price-slider -->
                                        </div><!-- End .filter-price -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->
                        </div><!-- End .sidebar sidebar-shop -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection

@section('script')
    <script src="{{ url('assets/js/wNumb.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ url('assets/js/nouislider.min.js') }}"></script>
    <script type="text/javascript">
        $('.ChangeSortBy').change(function () {
            let id = $(this).val();
            $('#get_sort_by_id').val(id);
            FilterForm();
        });

        $('.ChangeCategory').change(function () {
            let ids = '';
           $('.ChangeCategory').each(function () {
                if (this.checked) {
                    let id = $(this).val();
                    ids += id+',';
                }
            });
           $('#get_sub_category_id').val(ids);
            FilterForm();
        });

        $('.ChangeBrand').change(function () {
            let ids = '';
            $('.ChangeBrand').each(function () {
                if (this.checked) {
                    let id = $(this).val();
                    ids += id+',';
                }
            });
            $('#get_brand_id').val(ids);
            FilterForm();
        });

        $('.ChangeColor').click(function () {
            let id = $(this).attr('id');
            let status = $(this).attr('data-val');

            if(status == 0) {
                $(this).attr('data-val', 1);
                $(this).addClass('active-color')
            } else {
                $(this).attr('data-val', 0);
                $(this).removeClass('active-color')
            }

            let ids = '';
            $('.ChangeColor').each(function () {
                let status = $(this).attr('data-val');
                if (status == 1) {
                    let id = $(this).attr('id');
                    ids += id+',';
                }
            });

            $('#get_color_id').val(ids);
            FilterForm();
        });

        let xhr ;
        function FilterForm() {
            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            xhr = $.ajax({
                type : "POST",
                url : "{{ url('get_filter_product_ajax') }}",
                data : $('#FilterForm').serialize(),
                dataType : "json",
                success : function (data) {
                    $('#getProductAjax').html(data.success)
                    $('.LoadMore').attr('data-page', data.page)

                    if(data.page == 0) {
                        $('.LoadMore').hide()
                    } else {
                        $('.LoadMore').show()
                    }
                },
                error : function (data) {

                }
            })
        }

        // Pagination using AJAX
        $('body').delegate('.LoadMore', 'click', function () {
            let page = $(this).attr('data-page');
            $('.LoadMore').html('Loading ...')

            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            xhr = $.ajax({
                type : "POST",
                url : "{{ url('get_filter_product_ajax') }}?page="+page,
                data : $('#FilterForm').serialize(),
                dataType : "json",
                success : function (data) {
                    $('#getProductAjax').append(data.success)
                    $('.LoadMore').attr('data-page', data.page)
                    $('.LoadMore').html('Load More')

                    if(data.page == 0) {
                        $('.LoadMore').hide()
                    } else {
                        $('.LoadMore').show()
                    }
                },
                error : function (data) {

                }
            })
        });

        let i = 0

        // Slider For category pages / filter price
        if ( typeof noUiSlider === 'object' ) {
            let priceSlider  = document.getElementById('price-slider');

            noUiSlider.create(priceSlider, {
                start: [ 0, 750 ],
                connect: true,
                step: 50,
                margin: 50,
                range: {
                    'min': 0,
                    'max': 1000
                },
                tooltips: true,
                format: wNumb({
                    decimals: 0,
                    prefix: '$'
                })
            });

            // Update Price Range
            priceSlider.noUiSlider.on('update', function( values, handle ){
                let start_price = values[0];
                let end_price = values[1];
                $('#get_start_price').val(start_price);
                $('#get_end_price').val(end_price);
                $('#filter-price-range').text(values.join(' - '));
                if(i == 0 || i == 1) {
                    i++
                } else {
                    FilterForm();
                }
            });
        }
    </script>
@endsection
