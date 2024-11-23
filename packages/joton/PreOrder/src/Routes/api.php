<?php

use Illuminate\Support\Facades\Route;
use Joton\PreOrder\Http\Controllers\{PreOrderController, ProductCategoryController, ProductController, UserController};


// Route::middleware(['check.admin'])->group(function () {
Route::prefix('api')->group(function () {
    Route::get('/health', function () {
        return response()->json(['status' => 'Running healthy']);
    });

    // User routes 
    Route::apiResource('users', UserController::class);
    Route::post('users/{id}/restore', [UserController::class, 'restore']);

    // Category routes 
    Route::apiResource('categories', ProductCategoryController::class);
    Route::post('categories/{id}/restore', [ProductCategoryController::class, 'restore']);

    // Product routes 
    Route::apiResource('products', ProductController::class);
    Route::post('products/{id}/restore', [ProductController::class, 'restore']);

    // Pre-order routes 
    Route::apiResource('pre-orders', PreOrderController::class);
    Route::post('pre-orders/{id}/restore', [PreOrderController::class, 'restore']);
});
// });
