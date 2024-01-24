<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

            if (Auth::user()->role == 'guardian')
                return redirect('guardians/dashboard')
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
                return redirect('students/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'teacher')
                return redirect('teacher/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'guardian')
                return redirect('guardians/dashboard')
                    ->with('success', 'You are logged in successfully');

            if (Auth::user()->role == 'admin')
                return redirect('admin/dashboard')
                    ->with('success', 'You are logged in successfully');
        }
        return redirect()->back()->with('error', 'Enter valid credentials');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgotPassword');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::getEmailSingle($request->email);

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found');
        }

        $user->remember_token = Str::random(30);
        $user->save();

        Mail::to($user->email)->send(new ForgotPassword($user));

        return redirect()->back()->with('success', 'Email sent successfully to reset password');
    }

    public function sendResetToken($token)
    {
        $user = User::getTokenSingle(request()->token);
        if (!$user) {
            return redirect()->back()->with('error', 'Token not found');
        }
        return view('auth.resetPassword', compact('user'));
    }

    public function resetPassword($token, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->password != $request->confirmPassword) {
            return redirect()->back()->with('error', 'Password and confirm password does not match');
        }

        $user = User::getTokenSingle($token);

        if (!$user) {
            return redirect()->back()->with('error', 'Token not found');
        }

        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(30);
        $user->save();

        return redirect()->route('login')->with('success', 'Password reset successfully');
    }
}
