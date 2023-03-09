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
Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cleared";
});

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
Route::get('/get-product-type/{id?}', [App\Http\Controllers\ProductController::class, 'product_info'])->name('product_info');
Route::get('/product-duplicate/{id}', [App\Http\Controllers\ProductController::class, 'duplicate'])->name('product_duplicate');

Route::get('get-product-data/{id?}', [App\Http\Controllers\ProductController::class,'product_data'])->name('get.product');


// user controller
Route::resource('/customer',App\Http\Controllers\UserOrCustomerController::class);
Route::get('/customer-quote/{id?}',[App\Http\Controllers\UserOrCustomerController::class,'customer_quote'])->name('customer_quote');

Route::get('/all-client',[App\Http\Controllers\UserOrCustomerController::class,'allclient'])->name('allclient');
Route::get('get-client-data/{id}', [App\Http\Controllers\UserOrCustomerController::class, 'client_data'])->name('get_data');
Route::post('store-client', [App\Http\Controllers\UserOrCustomerController::class, 'client_store'])->name('client_store');

Route::get('/client/{id?}',[App\Http\Controllers\UserOrCustomerController::class,'clientinfo'])->name('clientinfo');


// Quote Controller
Route::resource('/quote', App\Http\Controllers\QuotesController::class);
Route::get('destroy/{var?}', [App\Http\Controllers\QuotesController::class,'destroy'])->name('destroy_item');
Route::get('duplicate-item/{var?}', [App\Http\Controllers\QuotesController::class,'duplicate_item'])->name('duplicate_item');
Route::get('/quote-duplicate/{var?}', [App\Http\Controllers\QuotesController::class,'duplicate'])->name('quote_riplicate');
// status change
Route::get('/image-status', [App\Http\Controllers\QuotesController::class,'image_status'])->name('image_status');
Route::get('/total-vat', [App\Http\Controllers\QuotesController::class,'total_vat_status'])->name('total_vat_status');
Route::get('/total-net', [App\Http\Controllers\QuotesController::class,'total_net_status'])->name('total_net_status');
Route::get('/gross-total', [App\Http\Controllers\QuotesController::class,'gross_total_status'])->name('gross_total_status');
Route::get('/net-price', [App\Http\Controllers\QuotesController::class,'net_price_status'])->name('net_price_status');
Route::get('/collect-status', [App\Http\Controllers\QuotesController::class,'collect_status'])->name('collect_status');
Route::get('/delivered-status', [App\Http\Controllers\QuotesController::class,'delivered_status'])->name('delivered_status');


Route::get('/quote-status', [App\Http\Controllers\QuotesController::class,'status'])->name('quote_status');
Route::get('/quote/create/{var?}', [App\Http\Controllers\QuotesController::class,'create'])->name('quote.create');
Route::get('/reports/',[App\Http\Controllers\QuotesController::class,'reports'])->name('reports');// reports bwtween dates
Route::post('/create-quote/',[App\Http\Controllers\QuotesController::class,'create_quote'])->name('create_quote');// reports bwtween dates
Route::get('preview-pdf/{id}', [App\Http\Controllers\QuotesController::class,'pdf'])->name('quote.pdf');

// Delievery Charges
Route::resource('/deliverycharges', App\Http\Controllers\DeliveryChargesController::class);
