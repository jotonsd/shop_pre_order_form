<?php

use Illuminate\Support\Facades\Route;
use Joton\PreOrder\Http\Controllers\{AuthController, PreOrderController, ProductCategoryController, ProductController, UserController};


// Route::middleware(['check.admin'])->group(function () {
Route::prefix('api')->group(function () {
    Route::get('/health', function () {
        return response()->json(['status' => 'Running healthy']);
    });

    // User login 
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // User logout 
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
});
// });
