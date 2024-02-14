<?php 

use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\Admin\LoginController;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login','showLoginForm')->name('login');
    Route::post('/login','login');
    Route::post('/logout','logout')->name('logout');
});

