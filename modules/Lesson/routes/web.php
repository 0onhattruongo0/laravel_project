<?php

use Illuminate\Support\Facades\Route;
use Modules\Lesson\src\Http\Controllers\LessonController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(LessonController::class)->prefix('lessons')->name('lessons.')->group(function () {
        Route::get('/{courseId}', 'index')->name('index');
        Route::get('/data/{courseId}', 'data')->name('data');
        Route::get('/{courseId}/create', 'create')->name('create');
        Route::post('/{courseId}/create', 'store')->name('store');
        Route::get('/edit/{lesson}', 'edit')->name('edit');
        Route::post('/edit/{lesson}', 'update')->name('update');
        Route::post('/delete/{id}', 'delete')->name('delete');
    });
});
