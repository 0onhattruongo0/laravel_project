<?php

use Illuminate\Support\Facades\Route;
use Modules\Lesson\src\Http\Controllers\LessonController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(LessonController::class)->prefix('lessons')->name('lessons.')->middleware('can:lessons')->group(function () {
        Route::get('/{courseId}', 'index')->name('index');
        Route::get('/data/{courseId}', 'data')->name('data');
        Route::get('/{courseId}/create', 'create')->name('create')->can('lessons.add');
        Route::post('/{courseId}/create', 'store')->name('store')->can('lessons.add');
        Route::get('/edit/{lesson}', 'edit')->name('edit')->can('lessons.edit');
        Route::post('/edit/{lesson}', 'update')->name('update')->can('lessons.edit');
        Route::post('/delete/{id}', 'delete')->name('delete')->can('lessons.delete');
    });
});
