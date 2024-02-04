<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;




Route::group([
'middleware'=>['auth'],
'as'=>'dashboard.',
'prefix'=>'dashboard',

],function(){
    Route::get('/',[DashboardController::class,'index'])
    ->name('dashboard');

    Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
        ->name('categories.force-delete');
        Route::get('/categories/trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');
        Route::resource('categories',CategoriesController::class);


});