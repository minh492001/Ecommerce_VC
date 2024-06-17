<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;

Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/admin/list', [AdminController::class, 'list']);

    Route::get('admin/admin/add', [AdminController::class, 'add']);

    Route::post('admin/admin/add', [AdminController::class, 'insert']);

    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);

    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

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

});
