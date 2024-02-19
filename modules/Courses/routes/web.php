<?php

use Illuminate\Support\Facades\Route;

use Modules\Courses\src\Http\Controllers\CoursesController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(CoursesController::class)->prefix('courses')->middleware('can:courses')->name('courses.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/create', 'create')->name('create')->can('courses.add');
        Route::post('/create', 'store')->name('store')->can('courses.add');
        Route::get('/edit/{course}', 'edit')->name('edit')->can('courses.edit');
        Route::put('/edit/{course}', 'update')->name('update')->can('courses.edit');
        Route::post('/delete/{course}', 'delete')->name('delete')->can('courses.delete');
    });
});
