<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\src\Http\Controllers\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/khoa-hoc/{slug}', 'course')->name('course');
    Route::get('/bai-hoc/{slug}', 'lesson')->name('lesson')->middleware('homeLogin');
    Route::get('/mua-khoa-hoc/{course}', 'payment')->name('payment')->middleware('homeLogin');
    Route::post('/finish', 'updatefinish')->name('finish')->middleware('homeLogin');
    Route::get('/hoc-vien', 'student')->name('student')->middleware('homeLogin');
    Route::post('/hoc-vien', 'updateStudent')->middleware('homeLogin');
});
