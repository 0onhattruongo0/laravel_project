<?php 
use Illuminate\Support\Facades\Route;
use Modules\Dashboard\src\Http\Controllers\DashboardController;


Route::prefix('admin')->group(function(){
        Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
});