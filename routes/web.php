<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/product', App\Http\Controllers\ProductController::class);
Route::get('/product-duplicate/{id}', [App\Http\Controllers\ProductController::class, 'duplicate'])->name('product_duplicate');

// user controller
Route::resource('/customer',App\Http\Controllers\UserOrCustomerController::class);
Route::get('/customer-quote/{id}',[App\Http\Controllers\UserOrCustomerController::class,'customer_quote'])->name('customer_quote');
