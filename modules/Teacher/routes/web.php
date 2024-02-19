<?php

use Illuminate\Support\Facades\Route;

use Modules\Teacher\src\Http\Controllers\TeachersController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(TeachersController::class)->prefix('teachers')->middleware('can:teachers')->name('teachers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/create', 'create')->name('create')->can('teachers.add');
        Route::post('/create', 'store')->name('store')->can('teachers.add');
        Route::get('/edit/{teacher}', 'edit')->name('edit')->can('teachers.edit');
        Route::post('/edit/{teacher}', 'update')->name('update')->can('teachers.edit');
        Route::post('/delete/{teacher}', 'delete')->name('delete')->can('teachers.delete');
    });
});
