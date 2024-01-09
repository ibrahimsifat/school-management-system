<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

// public route
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgotPassword');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('/reset/{token}', [AuthController::class, 'sendResetToken']);
Route::post('/reset/{token}', [AuthController::class, 'resetPassword']);

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');






//student group route
Route::group(['prefix' => 'student', 'middleware' => 'student'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');
});

//teacher group route
Route::group(['prefix' => 'teacher', 'middleware' => 'teacher'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('teacher.dashboard');
});

//parent group route
Route::group(['prefix' => 'parent', 'middleware' => 'parent'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('parent.dashboard');
});

//admin group route
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard/list', function () {
        return view('admin.admin.index');
    })->name('admin.list');
});
