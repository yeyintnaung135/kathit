<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\backend\ProductsController;
use App\Http\Controllers\backend\BannerController;

Route::get('/backend/home', function(){
  return view('backend.home');
})->middleware('auth:admins');

Route::group(['prefix' => '/backend/product', 'as'=>'backend.product.'],function (){
  Route::controller(ProductsController::class)->group(function(){
    Route::get('/list','list');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/get_all_products','get_all_products');
    Route::get('/edit/{id}','edit');
    Route::post('/update/{id}','update');
    Route::delete('/delete/{id}','destroy');
    Route::get('/trash','trash');
    Route::get('/restore/{id}','restore');
    Route::delete('/force_delete/{id}','forceDelete');
  });
});

Route::group(['prefix' => '/backend/banner', 'as'=>'backend.banner.'],function (){
  Route::controller(BannerController::class)->group(function(){
    Route::get('/list','index');
        Route::get('/create','create');
        Route::post('/store','store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::put('/update/{id}','update')->name('update');
        Route::get('/delete/{id}','delete')->name('delete');
  });

});

Route::get('/adminlogin', [LoginController::class, 'showAdminLoginForm'])->name('adminlogin');
Route::post('/adminlogin', [LoginController::class, 'adminLogin']);
Route::get('/adminregister', [RegisterController::class, 'showAdminRegisterForm']);
Route::post('/adminregister', [RegisterController::class, 'adminregister']);
Route::post('/adminlogout', [LoginController::class, 'adminlogout']);
// Route::get('/adminforgot', [AdminsForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
// Route::post('/adminsendemail', [AdminsForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

?>
