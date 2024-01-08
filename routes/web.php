<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');

Route::get('/admin/dashboard/list', function () {
    return view('admin.admin.index');
})->name('admin.list');


//admin group route
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

//student group route
Route::group(['middleware' => 'student'], function () {
    Route::get('/student/dashboard', function () {
        return view('admin.dashboard');
    })->name('student.dashboard');
});

//teacher group route
Route::group(['middleware' => 'teacher'], function () {
    Route::get('/teacher/dashboard', function () {
        return view('admin.dashboard');
    })->name('teacher.dashboard');
});

//parent group route
Route::group(['middleware' => 'parent'], function () {
    Route::get('/parent/dashboard', function () {
        return view('admin.dashboard');
    })->name('parent.dashboard');
});
