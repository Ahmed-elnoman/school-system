<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('dashboard' , [UserController::class, 'dashboard'])->name('dashboard');

    // account routes
    Route::prefix('account')->group( function() {
        Route::get('index',  'AccountController@index')->name('account.index');
        Route::post('store', 'AccountController@store')->name('account.store');
        Route::put('update', 'AccountController@update')->name('account.update');
        Route::get('print_account/{id}', 'AccountController@print')->name(('account.print'));
        Route::delete('delete', 'AccountController@delete')->name('account.delete');

    });


    // department routes
    Route::prefix('department')->group( function() {
        Route::get('index', 'DepartmentController@index')->name('department.index');
        Route::post('store', 'DepartmentController@store')->name('department.store');
        Route::put('update', 'DepartmentController@update')->name('department.update');
        Route::delete('delete', 'DepartmentController@delete')->name('department.delete');
    });


    // teacher routes
    Route::prefix('teacher')->group( function() {
        Route::get('index', 'TeacherController@index')->name('teacher.index');
        Route::get('create', 'TeacherController@create')->name('teacher.create');
        Route::post('store', 'TeacherController@store')->name('teacher.store');
        Route::get('edit/{id}', 'TeacherController@edit')->name('teacher.edit');
        Route::put('update/{id}', 'TeacherController@update')->name('teacher.update');
        Route::post('freeze', 'TeacherController@freeze')->name('teacher.freeze');
        Route::post('send/messages', 'TeacherController@sendMessage')->name('teacher.send.message');
        Route::get('freezes/get', 'TeacherController@getFreezes')->name('teacher.get.freezes');
        Route::delete('freezes/delete', 'TeacherController@deleteFreeze')->name('teacher.delete.freeze');
        Route::delete('softDelete', 'TeacherController@softDelete')->name('teacher.soft');
        Route::get('Trashed/get', 'TeacherController@getTrashed')->name('teacher.getTrashed');
        Route::post('withTrashed', 'TeacherController@withTrashed')->name('teacher.withTrashed');
        Route::get('department', 'TeacherController@teacherDepart')->name('teacher.depart');
        Route::delete('delete', 'TeacherController@delete')->name('teacher.delete');
    });


    // class room routes
    Route::prefix('class')->group( function() {
        Route::get('index', 'ClassRoomController@index')->name('class.index');
        Route::post('store', 'ActivityController@store')->name('class.store');
        Route::put('update', 'ClassRoomController@update')->name('class.update');
    });


    // charge for routes
    Route::get('charge_for/index', 'ChargeForController@index')->name('charge.index');
    Route::post('charge_for/store', 'ChargeForController@store')->name('charge.store');
    Route::put('charge_for/update', 'ChargeForController@update')->name('charge.update');

    // an_exception routes
    Route::post('an_exception/store', 'AnExceptionController@store')->name('an_exception.store');
    Route::put('an_exception/update', 'AnExceptionController@update')->name('an_exception.update');
    Route::delete('an_exception/delete', 'AnExceptionController@delete')->name('an_exception.delete');

    // student route
    Route::get('student/index','StudentController@index')->name('student.index');
    Route::get('student/class_room/get_charge/{id}','StudentController@getCharge');
    Route::get('student/edit/class_room/get_charge/{id}','StudentController@getCharge');
    Route::get('student/an_exception/get_an_exception/{id}','StudentController@an_exception');
    Route::get('student/edit/an_exception/get_an_exception/{id}','StudentController@an_exception');
    Route::get('student/create','StudentController@create')->name('student.create');
    Route::get('student/getStudentByClass','StudentController@getStudentByClass')->name('student.getStudentByClass');
    Route::post('student/store','StudentController@store')->name('student.store');
    Route::get('student/edit/{id}','StudentController@edit')->name('student.edit');
    Route::put('student/update/{id}','StudentController@update')->name('student.update');
    Route::post('student/send/message','StudentController@sendMessage')->name('student.send.message');
    Route::post('student/issues','StudentController@problem')->name('student.problem');
    Route::delete('student/softDelete','StudentController@softDelete')->name('student.softDelete');
    Route::get('student/Trashed/get','StudentController@getTrashed')->name('student.getTrashed');
    Route::post('student/withTrashed','StudentController@withTrashed')->name('student.withTrashed');
    Route::delete('student/delete','StudentController@delete')->name('student.delete');

    // subject routes
    Route::prefix('subject')->group( function() {
        Route::get('index', 'SubjectController@index')->name('subject.index');
        Route::post('store', 'SubjectController@store')->name('subject.store');
        Route::put('update', 'SubjectController@update')->name('subject.update');
    });


    // exam routes
    Route::prefix('exam')->group( function() {
        Route::get('index', 'ExamController@index')->name('exam.index');
        Route::post('store', 'ExamController@store')->name('exam.store');
    });


    // result routes
    Route::prefix('result')->group( function() {
        Route::get('index', 'ResultController@index')->name('result.index');
        Route::get('search/new', 'ResultController@searchNew')->name('result.search.new');
        Route::get('addResultSubject/{id}', 'ResultController@addResultSubject')->name('result.addResultSubject');
        Route::get('showAllResult', 'ResultController@showAllResult')->name('result.showAllResult');
        Route::post('store', 'ResultController@store')->name('result.store');
        Route::get('show/student/result', 'ResultController@showStudentResult')->name('result.student.result');
        Route::get('time/{id}', 'ResultController@resultTime')->name('result.time');
        Route::put('update', 'ResultController@update')->name('result.update');
        Route::get('print/{id}', 'ResultController@print')->name('result.print');
    });


    // time table route
    Route::prefix('time_table')->group( function() {
        Route::get('time_table/index', 'TimeTableController@index')->name('time.index');
        Route::get('time_table/show', 'TimeTableController@show')->name('time.show');
        Route::post('time_table/store', 'TimeTableController@store')->name('time.store');
        Route::get('time_table/print/{name}', 'TimeTableController@print')->name('time.print');
    });


    // activity routes
    Route::prefix('activity')->group( function() {
        Route::get('activity/index','ActivityController@index')->name('activity.index');
        Route::post('activity/store','ActivityController@store')->name('activity.store');
        Route::delete('activity/delete', 'ActivityController@delete')->name('activity.delete');
    });



});

Route::get('login' , [UserController::class, 'login'])->name('login');
Route::post('log' , [UserController::class, 'log'])->name('log');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('user/profile/{id}', [UserController::class, 'profile'])->name('profile');