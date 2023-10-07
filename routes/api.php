<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\FlashSale\FlashSaleController;
use App\Http\Controllers\Api\User\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'get');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'get');
    Route::post('/product/find', 'find');
    Route::post('/product', 'store');
});

Route::controller(CartController::class)->group(function () {
    Route::post('/cart/getByUserId', 'get');
    Route::post('/cart', 'store');
    Route::put('/cart', 'update');
    Route::delete('/cart', 'delete');
});

Route::controller(FlashSaleController::class)->group(function () {
    Route::get('/flash-sale', 'get');
    Route::post('/flash-sale', 'store');
    Route::post('/flash-sale/deactive', 'deactive');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/order', 'get');
    Route::post('/order/getByUserId', 'getByUserId');
    Route::post('/order/find', 'find');
    Route::post('/order', 'store');
});
