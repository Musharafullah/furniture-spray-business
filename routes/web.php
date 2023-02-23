<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/logout', function ()
{
    Auth::logout();
});
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/product', App\Http\Controllers\ProductController::class);
Route::get('/product-duplicate/{id}', [App\Http\Controllers\ProductController::class, 'duplicate'])->name('product_duplicate');

Route::get('get-product-data/{id}', [App\Http\Controllers\ProductController::class,'product_data'])->name('get.product');


// user controller
Route::resource('/customer',App\Http\Controllers\UserOrCustomerController::class);
Route::get('/customer-quote/{id}',[App\Http\Controllers\UserOrCustomerController::class,'customer_quote'])->name('customer_quote');

Route::get('/all-client',[App\Http\Controllers\UserOrCustomerController::class,'allclient'])->name('allclient');
Route::get('get-client-data/{id}', [App\Http\Controllers\UserOrCustomerController::class, 'client_data'])->name('get_data');
Route::post('store-client', [App\Http\Controllers\UserOrCustomerController::class, 'client_store'])->name('client_store');

Route::get('/client/{id?}',[App\Http\Controllers\UserOrCustomerController::class,'clientinfo'])->name('clientinfo');


// Quote Controller
Route::resource('/quote', App\Http\Controllers\QuotesController::class);

