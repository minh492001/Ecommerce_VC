<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title'] = 'E-commerce_VC';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('home', $data);
    }
}
