<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', CatalogController::class)
    ->name('catalog');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');
Route::post('/cart/add-product', [CartController::class, 'addProduct'])
    ->name('cart.add-product');
Route::post('/cart/remove-product', [CartController::class, 'removeProduct'])
    ->name('cart.remove-product');
