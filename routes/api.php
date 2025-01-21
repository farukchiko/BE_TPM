<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register-team', [AuthController::class, 'register']);
Route::post('/login-leader', [AuthController::class, 'login']);

Route::middleware('auth.token')->group(function () {
    Route::post('/logout-leader', [AuthController::class, 'logout']);
});