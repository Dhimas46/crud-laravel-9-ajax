<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('users', [UsersController::class, 'index']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('loginPost');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('register', [AuthController::class, 'registerView']);
// Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'details']);
Route::get('product/edit/{id}', [ProductController::class, 'edit']);
Route::post('product/update/{id}', [ProductController::class, 'update']);
Route::post('product', [ProductController::class, 'store']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
