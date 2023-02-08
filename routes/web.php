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
  Route::get('/product/detail/{id}', [FrontController::class, 'product_detail']);
  

});

require "backend.php";