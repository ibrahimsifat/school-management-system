<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {

        if (Auth::user()) {
            if (Auth::user()->role == 'student')
                return redirect('student/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'teacher')
                return redirect('teacher/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'parent')
                return redirect('parent/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'admin')
                return redirect('admin/dashboard')
                    ->with('success', 'You are logged in successfully');
        }
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
            // Authentication passed...
            if (Auth::user()->role == 'student')
                return redirect('student/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'teacher')
                return redirect('teacher/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'parent')
                return redirect('parent/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'admin')
                return redirect('admin/dashboard')
                    ->with('success', 'You are logged in successfully');
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
