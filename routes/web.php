<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
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

Route::get('/products', function () {
    return view('products.get');
});

Route::get('/users', function () {
    return view('users.get');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/register', 'registerView');
});

Route::controller(ProductController::class)->group(function () {
    // Route::get('/products', 'index');
    Route::post('/add-product', 'store')->name('add.product');
});
