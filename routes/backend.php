<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\backend\ProductsController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\ColorController;
use App\Http\Controllers\backend\VideoController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\OrderController;

Route::get('/backend/home', function(){
  return view('backend.home');
})->middleware('auth:admins');

Route::group(['prefix' => '/backend/product', 'as'=>'backend.product.'],function (){
  Route::controller(ProductsController::class)->group(function(){
    Route::get('/list','list')->name('list');
    Route::get('/create','create');
    Route::post('/store','store')->name('store');
    Route::get('/get_all_products','get_all_products');
    Route::get('/edit/{id}','edit');
    Route::post('/update/{id}','update')->name('update');
    Route::delete('/delete/{id}','destroy');
    Route::get('/trash','trash');
    Route::get('/restore/{id}','restore');
    Route::delete('/force_delete/{id}','forceDelete');
  });
});

Route::group(['prefix' => '/backend/color', 'as'=>'backend.color.'],function (){
  Route::controller(ColorController::class)->group(function(){
    Route::get('/list','index');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
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

Route::group(['prefix' => '/backend/order', 'as'=>'backend.order.'],function (){
  Route::controller(OrderController::class)->group(function(){
    Route::get('/list','index');
    Route::get('/get_all_orders','get_all_orders');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/update','update')->name('update');
    // Route::get('/delete/{id}','delete')->name('delete');
  });

});

Route::group(['prefix' => '/backend/video', 'as'=>'backend.video.'],function (){
  Route::controller(VideoController::class)->group(function(){
    Route::get('/list','index');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
  });

});

Route::group(['prefix' => '/backend/contact', 'as'=>'backend.contact.'],function (){
  Route::controller(ContactController::class)->group(function(){
    Route::get('/edit','edit');
    Route::put('/update/{id}','update');
  });

});

Route::get('/adminlogin', [LoginController::class, 'showAdminLoginForm'])->name('adminlogin');
Route::post('/adminlogin', [LoginController::class, 'adminLogin']);
Route::get('/adminregister', [RegisterController::class, 'showAdminRegisterForm']);
Route::post('/adminregister', [RegisterController::class, 'adminregister']);
Route::post('/adminlogout', [LoginController::class, 'adminlogout']);
Route::get('/adminforgot', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('/adminsendemail', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/password/adminreset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('/password/adminreset', [AdminResetPasswordController::class, 'reset']);
?>
