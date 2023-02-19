<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontController;
// use App\Http\Controllers\frontend\FrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => ['web']], function () {
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('/', [FrontController::class, 'index']);
  Route::get('/products', [FrontController::class, 'products']);
  Route::get('/product/detail/{id}', [FrontController::class, 'product_detail']);
  Route::get('/shoppagination/fetch_data', [FrontController::class, 'fetch_data']);

  Route::get('/products-category/{category}/{id}', [FrontController::class, 'productsByCat']);
  Route::get('/categorypagination/fetch_data', [FrontController::class, 'category_fetch_data']);

  Route::get('/videos', [FrontController::class, 'videos']);

  Route::get('/about', [FrontController::class, 'about']);
  Route::get('/contact', [FrontController::class, 'contact']);
  Route::post('/contact-message', [FrontController::class, 'store_message']);

  Route::get('/account', [FrontController::class,'account']);
  
  Route::get('/customize', [FrontController::class,'customize']);
  

});

require "backend.php";