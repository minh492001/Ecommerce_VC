<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ProductFront;

Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);

//Admin Middleware
Route::group(['middleware' => 'admin'], function () {
//    Admin routes
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/admin/list', [AdminController::class, 'list']);

    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);

    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);

    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

//    Customer routes
    Route::get('admin/customer/list', [CustomerController::class, 'list']);

    Route::get('admin/customer/delete/{id}', [CustomerController::class, 'delete']);

//    Order routes
    Route::get('admin/orders/list', [OrderController::class, 'list']);

    Route::get('admin/orders/detail/{id}', [OrderController::class, 'detail']);

    Route::get('admin/order-status', [OrderController::class, 'order_status']);

//    Category routes
    Route::get('admin/category/list', [CategoryController::class, 'list']);

    Route::get('admin/category/add', [CategoryController::class, 'add']);
    Route::post('admin/category/add', [CategoryController::class, 'insert']);

    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'update']);

    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);

//    Sub Category routes
    Route::get('admin/sub_category/add', [SubCategoryController::class, 'add']);

    Route::post('admin/sub_category/add', [SubCategoryController::class, 'insert']);
    Route::get('admin/sub_category/list', [SubCategoryController::class, 'list']);

    Route::get('admin/sub_category/edit/{id}', [SubCategoryController::class, 'edit']);
    Route::post('admin/sub_category/edit/{id}', [SubCategoryController::class, 'update']);

    Route::get('admin/sub_category/delete/{id}', [SubCategoryController::class, 'delete']);

    Route::post('admin/get_sub_category', [SubCategoryController::class, 'get_sub_category']);

//    Brand routes
    Route::get('admin/brand/list', [BrandController::class, 'list']);

    Route::get('admin/brand/add', [BrandController::class, 'add']);
    Route::post('admin/brand/add', [BrandController::class, 'insert']);

    Route::get('admin/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::post('admin/brand/edit/{id}', [BrandController::class, 'update']);

    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);

//    Color routes
    Route::get('admin/color/list', [ColorController::class, 'list']);

    Route::get('admin/color/add', [ColorController::class, 'add']);
    Route::post('admin/color/add', [ColorController::class, 'insert']);

    Route::get('admin/color/edit/{id}', [ColorController::class, 'edit']);
    Route::post('admin/color/edit/{id}', [ColorController::class, 'update']);

    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);

//    Product routes
    Route::get('admin/product/list', [ProductController::class, 'list']);

    Route::get('admin/product/add', [ProductController::class, 'add']);
    Route::post('admin/product/add', [ProductController::class, 'insert']);

    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('admin/product/edit/{id}', [ProductController::class, 'update']);

//    Delete Product Image
    Route::get('admin/product/image_delete/{id}', [ProductController::class, 'image_delete']);

//    Discount Code routes
    Route::get('admin/discount_code/list', [DiscountCodeController::class, 'list']);

    Route::get('admin/discount_code/add', [DiscountCodeController::class, 'add']);
    Route::post('admin/discount_code/add', [DiscountCodeController::class, 'insert']);

    Route::get('admin/discount_code/edit/{id}', [DiscountCodeController::class, 'edit']);
    Route::post('admin/discount_code/edit/{id}', [DiscountCodeController::class, 'update']);

    Route::get('admin/discount_code/delete/{id}', [DiscountCodeController::class, 'delete']);

//    Shipping Charge routes
    Route::get('admin/shipping_charges/list', [ShippingChargeController::class, 'list']);

    Route::get('admin/shipping_charges/add', [ShippingChargeController::class, 'add']);
    Route::post('admin/shipping_charges/add', [ShippingChargeController::class, 'insert']);

    Route::get('admin/shipping_charges/edit/{id}', [ShippingChargeController::class, 'edit']);
    Route::post('admin/shipping_charges/edit/{id}', [ShippingChargeController::class, 'update']);

    Route::get('admin/shipping_charges/delete/{id}', [ShippingChargeController::class, 'delete']);

});

//User Middleware
Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [UserController::class, 'dashboard']);

    Route::get('user/orders', [UserController::class, 'orders']);
    Route::get('user/orders/detail/{id}', [UserController::class, 'orders_detail']);

    Route::get('user/edit-profile', [UserController::class, 'edit_profile']);
    Route::post('user/edit-profile', [UserController::class, 'update_profile']);

    Route::get('user/change-password', [UserController::class, 'change_password']);
    Route::post('user/change-password', [UserController::class, 'update_password']);
});

//Home route
Route::get('/', [HomeController::class, 'home']);

//User Login
Route::post('login', [AuthController::class, 'login']);

//User Logout
Route::get('logout', [AuthController::class, 'logout']);

//User Register
Route::post('register', [AuthController::class, 'register']);

//Register Email Verify
Route::get('activate/{id}', [AuthController::class, 'activate_email']);

//Cart routes
Route::get('cart', [PaymentController::class, 'cart']);
Route::post('update_cart', [PaymentController::class, 'update_cart']);
Route::get('cart/delete/{id}', [PaymentController::class, 'cart_delete']);

//Checkout routes
Route::get('checkout', [PaymentController::class, 'checkout']);
Route::post('checkout/apply-discount-code', [PaymentController::class, 'apply_discount_code']);
Route::post('checkout/place_order', [PaymentController::class, 'place_order']);
Route::get('checkout/payment', [PaymentController::class, 'payment']);
Route::get('paypal/payment-success', [PaymentController::class, 'paypal_success']);
Route::get('stripe/payment-success', [PaymentController::class, 'stripe_success']);

//Add to Cart route
Route::post('product/add-to-cart', [PaymentController::class, 'add_to_cart']);

//Search route
Route::get('search', [ProductFront::class, 'searchProduct']);

//Filters Product Listing route
Route::post('get_filter_product_ajax', [ProductFront::class, 'getFilterProduct']);

//Product with slug route
Route::get('{category?}/{subcategory?}', [ProductFront::class, 'getSlug']);
