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
                return view('student.dashboard', [
                    'title' => 'Student',
                ]);

            if (Auth::user()->role == 'teacher')
                return view(
                    'teacher.dashboard',
                    ['title' => 'Teacher']
                );

            if (Auth::user()->role == 'parent')
                return view(
                    'guardian.dashboard',
                    ['title' => 'Parent']
                );

            if (Auth::user()->role == 'admin')
                return view(
                    'admin.dashboard',
                    ['title' => 'Admin']
                );
        } else {
            return redirect()->route('login');
        }
    }
}
