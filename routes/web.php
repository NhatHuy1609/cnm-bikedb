<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GeneralController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/general', [GeneralController::class, 'index'])->name('general.index');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');;
Route::get('/users/{user}/cart', [CartController::class, 'show'])->name('users.cart.show');
Route::put('/carts', [CartController::class, 'update']);
Route::delete('/carts', [CartController::class, 'destroy']);
Route::post('/users/cart', [CartController::class, 'store']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook/stripe', [CheckoutController::class, 'handleWebhook'])->name('stripe.webhook');
