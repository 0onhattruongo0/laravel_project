<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\src\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/khoa-hoc', [HomeController::class, 'course'])->name('course');
Route::get('/mua-khoa-hoc', [HomeController::class, 'payment'])->name('payment');
