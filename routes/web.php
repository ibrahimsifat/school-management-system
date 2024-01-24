<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\AssignSubject;
use Illuminate\Contracts\Auth\Guard;
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
Route::group(['prefix' => 'students', 'middleware' => 'student'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');

    Route::get('/my-account', [UserController::class, 'editMyAccount'])->name('student.account');
    Route::post('/my-account', [UserController::class, 'updateStudentAccount']);

    // subject
    Route::get('/subjects', [SubjectController::class, 'subjects'])->name('student.subjects');

    Route::get('/change-password', [UserController::class, 'changePassword']);
    Route::post('/change-password', [UserController::class, 'updatePassword']);
});

//teacher group route
Route::group(['prefix' => 'teacher', 'middleware' => 'teacher'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('teacher.dashboard');

    Route::get('/my-account', [UserController::class, 'editMyAccount'])->name('teacher.account');
    Route::post('/my-account', [UserController::class, 'updateTeacherAccount']);

    Route::get('/change-password', [UserController::class, 'changePassword']);
    Route::post('/change-password', [UserController::class, 'updatePassword']);
});

//guardian group route
Route::group(['prefix' => 'guardians', 'middleware' => 'guardian'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('guardian.dashboard');
    Route::get('/my-account', [UserController::class, 'editMyAccount'])->name('guardian.account');
    Route::post('/my-account', [UserController::class, 'updateGuardianAccount']);
    Route::get('/change-password', [UserController::class, 'changePassword']);
    Route::post('/change-password', [UserController::class, 'updatePassword']);


    // students route
    Route::get('my-students', [StudentController::class, 'guardianStudents'])->name('guardian.students');
    Route::get('students/subjects/{student_id}', [StudentController::class, 'guardianStudentSubjects'])->name('guardian.students.subjects');
});

//admin group route
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    // admin profile route
    Route::get('/change-password', [UserController::class, 'changePassword']);
    Route::post('/change-password', [UserController::class, 'updatePassword']);

    Route::get('/my-account', [UserController::class, 'editMyAccount'])->name('admin.account');
    Route::post('/my-account', [UserController::class, 'updateAdminAccount']);

    // admin route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/list', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/create', [AdminController::class, 'store']);
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/edit/{id}', [AdminController::class, 'update']);
    Route::get('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/bulk-delete', [AdminController::class, 'bulkDelete'])->name('admin.bulkDelete');


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

    /// assign_subjects route
    Route::get('/assign_subjects', [AssignSubjectController::class, 'index'])->name('assignSubject.index');
    Route::get('/assign_subjects/create', [AssignSubjectController::class, 'create'])->name('assignSubject.create');
    Route::post('/assign_subjects/create', [AssignSubjectController::class, 'store']);
    Route::get('/assign_subjects/edit/{id}', [AssignSubjectController::class, 'edit'])->name('assignSubject.edit');
    Route::post('/assign_subjects/edit/{id}', [AssignSubjectController::class, 'update']);
    Route::get('/assign_subjects/edit_single/{id}', [AssignSubjectController::class, 'edit_single'])->name('assignSubject.edit_single');
    Route::post('/assign_subjects/edit_single/{id}', [AssignSubjectController::class, 'update_single']);
    Route::get('/assign_subjects/destroy/{id}', [AssignSubjectController::class, 'destroy']);


    // student route
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/students/create', [StudentController::class, 'store']);
    Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::post('/students/edit/{id}', [StudentController::class, 'update']);
    Route::get('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

    // guardians route guardians
    Route::get('/guardians', [GuardianController::class, 'index'])->name('guardian.index');
    Route::get('/guardians/create', [GuardianController::class, 'create'])->name('guardian.create');
    Route::post('/guardians/create', [GuardianController::class, 'store']);
    Route::get('/guardians/edit/{id}', [GuardianController::class, 'edit'])->name('guardian.edit');
    Route::post('/guardians/edit/{id}', [GuardianController::class, 'update']);
    Route::get('/guardians/students/edit/{id}', [GuardianController::class, 'editStudents'])->name('guardian.students.edit');
    Route::get('/guardians/students/add/{id}/{studentId}', [GuardianController::class, 'addStudent']);
    Route::get('/guardians/students/remove/{id}/{studentId}', [GuardianController::class, 'removeStudent']);
    Route::get('/guardians/destroy/{id}', [GuardianController::class, 'destroy'])->name('guardian.destroy');

    // teachers route teachers
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teachers/create', [TeacherController::class, 'store']);
    Route::get('/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::post('/teachers/edit/{id}', [TeacherController::class, 'update']);
    Route::get('/teachers/students/edit/{id}', [TeacherController::class, 'editStudents'])->name('teacher.students.edit');
    Route::get('/teachers/students/add/{id}/{studentId}', [TeacherController::class, 'addStudent']);
    Route::get('/teachers/students/remove/{id}/{studentId}', [TeacherController::class, 'removeStudent']);
    Route::get('/teachers/destroy/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');


    /// assign_class_teachers route
    Route::get('/assign_class_teachers', [AssignClassTeacherController::class, 'index'])->name('assignClassTeacher.index');
    Route::get('/assign_class_teachers/create', [AssignClassTeacherController::class, 'create'])->name('assignClassTeacher.create');
    Route::post('/assign_class_teachers/create', [AssignClassTeacherController::class, 'store']);
    Route::get('/assign_class_teachers/edit/{id}', [AssignClassTeacherController::class, 'edit'])->name('assignClassTeacher.edit');
    Route::post('/assign_class_teachers/edit/{id}', [AssignClassTeacherController::class, 'update']);
    Route::get('/assign_class_teachers/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single'])->name('assignClassTeacher.edit_single');
    Route::post('/assign_class_teachers/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);
    Route::get('/assign_class_teachers/destroy/{id}', [AssignClassTeacherController::class, 'destroy']);


    // file route
    Route::get('/files', [FileController::class, 'index'])->name('file.index');
    Route::get('/files/create', [FileController::class, 'create'])->name('file.create');
    Route::post('/files/create', [FileController::class, 'store']);
    Route::get('/files/edit/{id}', [FileController::class, 'edit'])->name('file.edit');
    Route::post('/files/edit/{id}', [FileController::class, 'update']);
    Route::get('/files/destroy/{id}', [FileController::class, 'destroy'])->name('file.destroy');
});
