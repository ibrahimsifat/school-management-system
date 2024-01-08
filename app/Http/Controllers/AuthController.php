<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {

        if (Auth::check())
            return redirect()->route('dashboard');

        return view('auth.login');
    }
    public function login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Enter valid credentials');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
