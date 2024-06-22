<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        if ($user->blocked) {
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'Akun Anda telah diblokir.']);
        }
        return redirect()->intended('/');
    }

    return redirect()->back()->withErrors(['email' => 'Email atau password tidak valid.']);
}
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
