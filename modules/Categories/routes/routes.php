<?php 
use Illuminate\Support\Facades\Route;


use Modules\Categories\src\Http\Controllers\CategoriesController;


Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(CategoriesController::class)->prefix('categories')->name('categories.')->middleware('web')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/data','data')->name('data');
        Route::get('/create','create')->name('create');
        Route::post('/create','store')->name('store');
        Route::get('/edit/{category}','edit')->name('edit');
        Route::post('/edit/{category}','update')->name('update');
        Route::post('/delete/{category}','delete')->name('delete');
    });
});