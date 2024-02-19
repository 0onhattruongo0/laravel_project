<?php

use Illuminate\Support\Facades\Route;
use Modules\Group\src\Http\Controllers\GroupController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(GroupController::class)->prefix('groups')->middleware('can:groups')->name('groups.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::get('/create', 'create')->name('create')->can('groups.add');
        Route::post('/create', 'store')->name('store')->can('groups.add');
        Route::get('/edit/{group}', 'edit')->name('edit')->can('groups.edit');
        Route::post('/edit/{group}', 'update')->name('update')->can('groups.edit');
        Route::post('/delete/{group}', 'delete')->name('delete')->can('groups.delete');
        Route::get('/permissions/{group}', [GroupController::class, 'permission'])->name('permissions')->can('groups.permission');
        Route::post('/permissions/{group}', [GroupController::class, 'postPermission'])->can('groups.permission');
    });
});
