<?php

// Import necessary classes
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;


// Define login route
Route::post('/login', [LoginController::class, 'login']);

// Protect the routes that require authentication using Sanctum middleware
Route::middleware('auth:sanctum')->group(function () {

    // Define routes for products resource controller
    Route::apiResource('products', ProductController::class);

    // Define routes for orders resource controller
     Route::apiResource('orders', OrderController::class);

    // Define routes for user resource controller
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // Define logout route
    Route::post('/logout', [LoginController::class, 'logout']);
});

?>