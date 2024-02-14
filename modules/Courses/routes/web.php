<?php 
use Illuminate\Support\Facades\Route;

use Modules\Courses\src\Http\Controllers\CoursesController;


Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(CoursesController::class)->prefix('courses')->name('courses.')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/data','data')->name('data');
        Route::get('/create','create')->name('create');
        Route::post('/create','store')->name('store');
        Route::get('/edit/{course}','edit')->name('edit');
        Route::put('/edit/{course}','update')->name('update');
        Route::post('/delete/{course}','delete')->name('delete');
    });
});