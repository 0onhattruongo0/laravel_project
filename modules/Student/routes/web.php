<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\src\Http\Controllers\StudentController;
use Modules\Auth\src\Http\Controllers\Admin\ResetPasswordController;
use Modules\Student\src\Http\Controllers\ResetPasswordStudentController;



Route::controller(StudentController::class)->name('students.')->group(function () {
    Route::get('/dang-ky', 'viewRegister')->name('viewRegister')->middleware('guest:student');
    Route::post('/dang-ky', 'postRegister')->name('postRegister');
    Route::get('/dang-nhap', 'viewLogin')->name('viewLogin')->middleware('guest:student'); //check nếu đã đăng nhập nó sẽ chuyển về trang home
    Route::post('/dang-nhap', 'postLogin')->middleware('guest:student');
    Route::get('/dang-xuat', 'logout')->name('logout')->middleware('auth:student'); //check có đăng nhập chưa nếu đăng nhập rồi mới hoạt động
    Route::get('/quen-mat-khau', 'forgetPassword')->name('forget_password')->middleware('guest:student');
    Route::post('/quen-mat-khau', 'sendResetLinkEmail')->name('email')->middleware('guest:student');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(StudentController::class)->prefix('students')->middleware('can:students')->name('students.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/active/{student}', 'edit')->name('edit')->can('students.edit');
        Route::post('/active/{student}', 'update')->name('update')->can('students.edit');
        Route::post('/delete/{student}', 'delete')->name('delete')->can('students.delete');
    });
});

Route::controller(ResetPasswordStudentController::class)->name('students.')->group(function () {
    Route::get('/đat-lai-mat-khau/{token}', 'showResetForm')->name('password_reset')->middleware('guest:student');
    Route::post('/đat-lai-mat-khau', 'reset')->name('password_update')->middleware('guest:student');
});

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
