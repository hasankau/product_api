<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Products\ProductListController;
use App\Http\Controllers\Products\ProductShowController;
use App\Http\Controllers\Products\ProductCreateController;
use App\Http\Controllers\Products\ProductEditController;
use App\Http\Controllers\Products\ProductDeleteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getProducts', [ProductListController::class, 'getProducts']);
    Route::get('/getProduct/{id}', [ProductShowController::class, 'getProduct']);
    Route::post('/createProduct', [ProductCreateController::class, 'createProduct']);
    Route::post('/editProduct', [ProductEditController::class, 'editProduct']);
    Route::post('/deleteProduct', [ProductDeleteController::class, 'deleteProduct']);
});
