<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()) {
            if (Auth::user()->role == 'student')
                return view('student.dashboard');

            if (Auth::user()->role == 'teacher')
                return view('teacher.dashboard');

            if (Auth::user()->role == 'parent')
                return view('parent.dashboard');

            if (Auth::user()->role == 'admin')
                return view('admin.dashboard');
        }
    }
}
