<?php


use App\Http\Controllers\HelloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StripeWebhookController;
use App\Models\Category;

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



Route::post('/webhook/stripe', [StripeWebhookController::class, 'handleWebhook']);


Route::get('/test', function () {
    return response()->json(['message' => 'test']);
});

Route::get('/categories/{category}/children', function (Category $category) {
    return $category->subCategories->map(function($category) {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'has_children' => $category->subCategories()->exists()
        ];
    });
});