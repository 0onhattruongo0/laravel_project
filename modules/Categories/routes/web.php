<?php

use Illuminate\Support\Facades\Route;


use Modules\Categories\src\Http\Controllers\CategoriesController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(CategoriesController::class)->prefix('categories')->middleware('can:categories')->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/create', 'create')->name('create')->can('categories.add');
        Route::post('/create', 'store')->name('store')->can('categories.add');
        Route::get('/edit/{category}', 'edit')->name('edit')->can('categories.edit');
        Route::post('/edit/{category}', 'update')->name('update')->can('categories.edit');
        Route::post('/delete/{category}', 'delete')->name('delete')->can('categories.delete');
    });
});
