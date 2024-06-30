<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard');
        }

        // Authentication kesalahan user
        Session::flash('error', 'Email atau password yang kamu masukan salah.');
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Email atau password yang kamu masukan salah.',
        ]);
    }
}