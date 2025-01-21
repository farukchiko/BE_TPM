<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rute untuk registrasi
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk login
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk logout (opsional, jika menggunakan token)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
