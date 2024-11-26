<?php

use Illuminate\Support\Facades\Route;
use Joton\PreOrder\Http\Controllers\{AuthController, PreOrderController, ProductCategoryController, ProductController, UserController};


Route::prefix('api')->group(function () {
    Route::get('/health', function () {
        return response()->json(['status' => 'Running healthy']);
    });
    Route::group(['middleware' => 'throttle:60'], function () {
        // User login 
        Route::post('/login', [AuthController::class, 'login'])->name('login');

        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::group(['middleware' => 'check.admin'], function () {
                // User routes 
                Route::apiResource('users', UserController::class);
                Route::post('users/{id}/restore', [UserController::class, 'restore']);

                // Category routes 
                Route::apiResource('categories', ProductCategoryController::class);
                Route::get('categories-all', [ProductCategoryController::class, 'getAll']);
                Route::post('categories/{id}/restore', [ProductCategoryController::class, 'restore']);

                // Product routes 
                Route::apiResource('products', ProductController::class);
                Route::get('products-all', [ProductController::class, 'getAll']);
                Route::post('products/{id}/restore', [ProductController::class, 'restore']);

                //pre-order restore
                Route::post('pre-orders/{id}/restore', [PreOrderController::class, 'restore']);
                Route::put('/pre-orders/{orderId}', [PreOrderController::class, 'update']);
                Route::delete('/pre-orders/{orderId}', [PreOrderController::class, 'destroy']);
            });

            // Pre-order routes 
            Route::get('/pre-orders', [PreOrderController::class, 'index']);
            Route::get('/pre-orders/{orderId}', [PreOrderController::class, 'show']);
            Route::get('/pre-orders/search/{query}', [PreOrderController::class, 'search']);

            // User logout 
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });

        Route::post('/pre-orders', [PreOrderController::class, 'store']);
    });
});
