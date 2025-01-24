<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;

// Public routes
Route::post('/register-user', [RegisterController::class, 'register']);
Route::post('/login-user', [LoginController::class, 'loginUser']);
Route::post('/login-admin', [LoginController::class, 'loginAdmin']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Route khusus user
    Route::get('/user/profile', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    });

    // Route khusus admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return response()->json(['message' => 'Welcome to Admin Dashboard']);
        });
    });
});
