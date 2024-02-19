<?php

use Illuminate\Support\Facades\Route;

use Modules\User\src\Http\Controllers\UserController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(UserController::class)->prefix('users')->middleware('can:users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/create', 'create')->name('create')->can('users.add');
        Route::post('/create', 'store')->name('store')->can('users.add');
        Route::get('/edit/{user}', 'edit')->name('edit')->can('users.edit');
        Route::post('/edit/{user}', 'update')->name('update')->can('users.edit');
        Route::post('/delete/{user}', 'delete')->name('delete')->can('users.delete');
    });
});
