<?php

use Illuminate\Support\Facades\Route;
use Modules\Lesson\src\Http\Controllers\LessonController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(LessonController::class)->prefix('lessons')->name('lessons.')->middleware('can:courses')->group(function () {
        Route::get('/{moduleId}', 'index')->name('index');
        Route::get('/data/{moduleId}', 'data')->name('data');
        Route::get('/{moduleId}/create', 'create')->name('create');
        Route::post('/{moduleId}/create', 'store')->name('store');
        Route::get('/edit/{lesson}', 'edit')->name('edit');
        Route::post('/edit/{lesson}', 'update')->name('update');
        Route::post('/delete/{id}', 'delete')->name('delete');
    });
});
