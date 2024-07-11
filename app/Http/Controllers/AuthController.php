<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class AuthController extends Controller
{
    public function login_admin()
    {
        if (!empty(Auth::check()) && Auth::user()->is_admin == 1) {
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0, 'is_delete' => 0], $remember))
        {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Please enter correct email or password');
        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('admin');
    }

    public function register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);
        if (empty($checkEmail)) {
            $user = new User;
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->password = Hash::make($request->password);
            $user->save();

            Mail::to($user->email)->send(new RegisterMail($user));

            $json['status'] = true;
            $json['message'] = 'Register successfully. Please verify your email address !';
        } else {
            $json['status'] = false;
            $json['message'] = 'Email already exists !';
        }
        echo json_encode($json);
    }

    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user = User::getSingle($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', 'Email verified successfully');
    }
}
