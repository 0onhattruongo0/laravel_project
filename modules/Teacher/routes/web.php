<?php 
use Illuminate\Support\Facades\Route;

use Modules\Teacher\src\Http\Controllers\TeachersController;


Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(TeachersController::class)->prefix('teachers')->name('teachers.')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/data','data')->name('data');
        Route::get('/create','create')->name('create');
        Route::post('/create','store')->name('store');
        Route::get('/edit/{teacher}','edit')->name('edit');
        Route::post('/edit/{teacher}','update')->name('update');
        Route::post('/delete/{teacher}','delete')->name('delete');
    });
});