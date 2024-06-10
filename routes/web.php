<?php

use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return view('admin.auth.login');
});

Route::get('/', function () {
    return view('welcome');
});

