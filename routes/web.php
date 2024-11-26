<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminBikeController;
use App\Http\Controllers\AdminAccessoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RatingController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/users/{user}/cart', [CartController::class, 'show'])->name('users.cart.show');
Route::put('/carts', [CartController::class, 'update']);
Route::delete('/carts', [CartController::class, 'destroy']);
Route::post('/users/cart', [CartController::class, 'store']);

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook/stripe', [CheckoutController::class, 'handleWebhook'])->name('stripe.webhook');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// Admin Routes
// Route::prefix('admin')->name('admin.')->middleware('auth', 'admin')->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    // Bikes management
    Route::get('bikes', [AdminBikeController::class, 'index'])->name('bikes.index');
    Route::get('bikes/create', [AdminBikeController::class, 'create'])->name('bikes.create');
    Route::post('bikes', [AdminBikeController::class, 'store'])->name('bikes.store');
    Route::get('bikes/{product}', [AdminBikeController::class, 'show'])->name('bikes.show');
    Route::get('bikes/{product}/edit', [AdminBikeController::class, 'edit'])->name('bikes.edit');
    Route::put('bikes/{product}', [AdminBikeController::class, 'update'])->name('bikes.update');
    Route::delete('bikes/{product}', [AdminBikeController::class, 'destroy'])->name('bikes.destroy');

    // Accessories management
    Route::get('accessories', [AdminAccessoryController::class, 'index'])->name('accessories.index');
    Route::get('accessories/create', [AdminAccessoryController::class, 'create'])->name('accessories.create');
    Route::post('accessories', [AdminAccessoryController::class, 'store'])->name('accessories.store');
    Route::get('accessories/{product}', [AdminAccessoryController::class, 'show'])->name('accessories.show');
    Route::get('accessories/{product}/edit', [AdminAccessoryController::class, 'edit'])->name('accessories.edit');
    Route::put('accessories/{product}', [AdminAccessoryController::class, 'update'])->name('accessories.update');
    Route::delete('accessories/{product}', [AdminAccessoryController::class, 'destroy'])->name('accessories.destroy');
});
