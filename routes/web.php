<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/users/{user}/cart',[CartController::class, 'show'])->name('users.cart.show');
Route::put('/carts',[CartController::class, 'update']);
Route::delete('/carts',[CartController::class, 'destroy']);
Route::post('/users/cart',[CartController::class, 'store']);