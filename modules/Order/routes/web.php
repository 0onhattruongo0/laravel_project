<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\src\Http\Controllers\OrderController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(OrderController::class)->prefix('orders')->name('orders.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
    });
});
