<?php


use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',

      ],function (){
        Route::get('/',[DashboardController::class,'index'])
            ->middleware(['auth'])
            ->name('dashboard');

        Route::resource('/categories',CategoryController::class);


});
