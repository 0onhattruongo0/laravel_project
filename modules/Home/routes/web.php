<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\src\Http\Controllers\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/khoa-hoc/{slug}', 'course')->name('course');
    Route::get('/bai-hoc/{slug}', 'lesson')->name('lesson');
    Route::get('/mua-khoa-hoc', 'payment')->name('payment');
    Route::post('/finish', 'updatefinish')->name('finish');
});
