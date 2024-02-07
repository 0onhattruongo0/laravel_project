<?php 
use Illuminate\Support\Facades\Route;

use Modules\User\src\Http\Controllers\UserController;


Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(UserController::class)->prefix('users')->name('users.')->middleware('web')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/data','data')->name('data');
        Route::get('/create','create')->name('create');
        Route::post('/create','store')->name('store');
        Route::get('/edit/{user}','edit')->name('edit');
        Route::post('/edit/{user}','update')->name('update');
        Route::post('/delete/{user}','delete')->name('delete');
    });
});
