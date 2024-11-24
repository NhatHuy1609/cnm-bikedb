<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StripeWebhookController;

Route::post('/webhook/stripe', [StripeWebhookController::class, 'handleWebhook']);

Route::get('/test', function () {
    return response()->json(['message' => 'test']);
});
