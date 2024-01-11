<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
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



// protected route


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

    // admin route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/list', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/create', [AdminController::class, 'store']);
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/edit/{id}', [AdminController::class, 'update']);
    Route::get('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


    /// course route
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/courses/create', [CourseController::class, 'store']);
    Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::post('/courses/edit/{id}', [CourseController::class, 'update']);
    Route::get('/courses/destroy/{id}', [CourseController::class, 'destroy']);

    /// subject route
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subjects/create', [SubjectController::class, 'store']);
    Route::get('/subjects/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::post('/subjects/edit/{id}', [SubjectController::class, 'update']);
    Route::get('/subjects/destroy/{id}', [SubjectController::class, 'destroy']);
});
