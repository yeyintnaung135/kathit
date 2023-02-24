<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontController;
use App\Http\Controllers\frontend\AccountController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\Customize\SuitCustomizeController;
use App\Http\Controllers\frontend\Customize\DressCustomizeController;

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
  Route::get('/products', [ProductController::class, 'products']);
  Route::get('/product/detail/{id}', [ProductController::class, 'product_detail']);
  Route::get('/shoppagination/fetch_data', [ProductController::class, 'fetch_data']);

  Route::get('/products-category/{category}/{id}', [ProductController::class, 'productsByCat']);
  Route::get('/categorypagination/fetch_data', [ProductController::class, 'category_fetch_data']);

  Route::get('/videos', [FrontController::class, 'videos']);

  Route::get('/about', [FrontController::class, 'about']);
  Route::get('/contact', [FrontController::class, 'contact']);
  Route::post('/contact-message', [FrontController::class, 'store_message']);

  Route::get('/account', [AccountController::class,'account']);
  
  Route::get('/customize/{id}', [AccountController::class,'customize']);
  Route::post('/dresscustomize', [DressCustomizeController::class, 'dresscustomize']);
  Route::post('/suitcustomize', [SuitCustomizeController::class, 'suitcustomize']);
  
  Route::get('/addtocart', [AccountController::class, 'addtocart']);
  Route::post('/storeproducttocart', [AccountController::class, 'storeproducttocart']);
  Route::post('/updatecart', [AccountController::class, 'updatecart']);
  Route::get('/billingaddress', [AccountController::class, 'billingaddress']);
  Route::post('/storebillingaddress', [AccountController::class, 'storebillingaddress']);
  Route::get('/payment', [AccountController::class, 'payment']);

});

require "backend.php";