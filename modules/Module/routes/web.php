<?php

use Modules\Module\src\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(ModuleController::class)->prefix('modules')->name('modules.')->middleware('can:courses')->group(function () {
        Route::get('/{courseId}', 'index')->name('index');
        Route::get('/data/{courseId}', 'data')->name('data');
        Route::get('/{courseId}/create', 'create')->name('create');
        Route::post('/{courseId}/create', 'store')->name('store');
        Route::get('/edit/{module}', 'edit')->name('edit');
        Route::post('/edit/{module}', 'update')->name('update');
        Route::post('/delete/{id}', 'delete')->name('delete');
    });
});
