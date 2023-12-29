<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AnExceptionController;
use App\Http\Controllers\ChargeForController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\UserController;
use App\Models\ChargeFor;
use Illuminate\Support\Facades\Route;
use App\Mail\Reqistration_teacher;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('dashboard' , [UserController::class, 'dashboard'])->name('dashboard');

    // account routes
    Route::get('account/index', [AccountController::class, 'index'])->name('account.index');
    Route::post('account/store', [AccountController::class, 'store'])->name('account.store');
    Route::put('account/update', [AccountController::class, 'update'])->name('account.update');
    Route::delete('account/delete', [AccountController::class, 'delete'])->name('account.delete');
    Route::get('account/print_account/{id}', [AccountController::class, 'print'])->name(('account.print'));


    // department routes
    Route::get('department/index', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::put('department/update', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('department/delete', [DepartmentController::class, 'delete'])->name('department.delete');

    // teacher routes
    Route::get('teacher/index', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('teacher/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::post('teacher/freeze', [TeacherController::class, 'freeze'])->name('teacher.freeze');
    Route::post('teacher/send/messages', [TeacherController::class, 'sendMessage'])->name('teacher.send.message');
    Route::get('teacher/freezes/get', [TeacherController::class, 'getFreezes'])->name('teacher.get.freezes');
    Route::delete('teacher/freezes/delete', [TeacherController::class, 'deleteFreeze'])->name('teacher.delete.freeze');
    Route::delete('teacher/softDelete', [TeacherController::class, 'softDelete'])->name('teacher.soft');
    Route::get('teacher/Trashed/get', [TeacherController::class, 'getTrashed'])->name('teacher.getTrashed');
    Route::post('teacher/withTrashed', [TeacherController::class, 'withTrashed'])->name('teacher.withTrashed');
    Route::get('teacher/department', [TeacherController::class, 'teacherDepart'])->name('teacher.depart');
    Route::delete('teacher/delete', [TeacherController::class, 'delete'])->name('teacher.delete');

    // class room routes
    Route::get('class_room/index', [ClassRoomController::class, 'index'])->name('class.index');
    Route::post('class_room/store', [ClassRoomController::class, 'store'])->name('class.store');
    Route::put('class_room/update', [ClassRoomController::class, 'update'])->name('class.update');

    // charge for routes
    Route::get('charge_for/index', [ChargeForController::class, 'index'])->name('charge.index');
    Route::post('charge_for/store', [ChargeForController::class, 'store'])->name('charge.store');
    Route::put('charge_for/update', [ChargeForController::class, 'update'])->name('charge.update');

    // an_exception routes
    Route::post('an_exception/store', [AnExceptionController::class, 'store'])->name('an_exception.store');
    Route::put('an_exception/update', [AnExceptionController::class, 'update'])->name('an_exception.update');
    Route::delete('an_exception/delete', [AnExceptionController::class, 'delete'])->name('an_exception.delete');

    // student route
    Route::get('student/index', [StudentController::class, 'index'])->name('student.index');
    Route::get('student/class_room/get_charge/{id}', [StudentController::class, 'getCharge']);
    Route::get('student/edit/class_room/get_charge/{id}', [StudentController::class, 'getCharge']);
    Route::get('student/an_exception/get_an_exception/{id}', [StudentController::class, 'an_exception']);
    Route::get('student/edit/an_exception/get_an_exception/{id}', [StudentController::class, 'an_exception']);
    Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
    Route::get('student/getStudentByClass', [StudentController::class, 'getStudentByClass'])->name('student.getStudentByClass');
    Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
    Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('student/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::post('student/send/message', [StudentController::class, 'sendMessage'])->name('student.send.message');
    Route::post('student/issues', [StudentController::class, 'problem'])->name('student.problem');
    Route::delete('student/softDelete', [StudentController::class, 'softDelete'])->name('student.softDelete');
    Route::get('student/Trashed/get', [StudentController::class, 'getTrashed'])->name('student.getTrashed');
    Route::post('student/withTrashed', [StudentController::class, 'withTrashed'])->name('student.withTrashed');
    Route::delete('student/delete', [StudentController::class, 'delete'])->name('student.delete');

    // subject routes
    Route::get('subject/index', [SubjectController::class, 'index'])->name('subject.index');
    Route::post('subject/store', [SubjectController::class, 'store'])->name('subject.store');
    Route::put('subject/update', [SubjectController::class, 'update'])->name('subject.update');

    // exam routes
    Route::get('exam/index', [ExamController::class, 'index'])->name('exam.index');
    Route::post('exam/store', [ExamController::class, 'store'])->name('exam.store');

    // result routes
    Route::get('result/index', [ResultController::class, 'index'])->name('result.index');
    Route::get('result/search/new', [ResultController::class, 'searchNew'])->name('result.search.new');
    Route::post('result/store', [ResultController::class, 'store'])->name('result.store');
    Route::get('result/time/{id}', [ResultController::class, 'resultTime'])->name('result.time');
    Route::put('result/update', [ResultController::class, 'update'])->name('result.update');
    Route::get('result/print/{id}', [ResultController::class, 'print'])->name('result.print');

    // time table route
    Route::get('time_table/index', [TimeTableController::class, 'index'])->name('time.index');
    Route::get('time_table/show', [TimeTableController::class, 'show'])->name('time.show');
    Route::post('time_table/store', [TimeTableController::class, 'store'])->name('time.store');
    Route::get('time_table/print/{name}', [TimeTableController::class, 'print'])->name('time.print');


});

Route::get('login' , [UserController::class, 'login'])->name('login');
Route::post('log' , [UserController::class, 'log'])->name('log');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('user/profile/{id}', [UserController::class, 'profile'])->name('profile');