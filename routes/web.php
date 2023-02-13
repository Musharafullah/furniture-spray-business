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

Route::get('/home/{slug?}/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'create'])->name('add_product');
Route::post('/product-save', [App\Http\Controllers\ProductController::class, 'store'])->name('product_store');
// DashboardDataController
// Route::get('/nav/{slug}', [App\Http\Controllers\DashboardDataController::class, 'navbar_pages'])->name('navbar_pages');
