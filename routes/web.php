<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\AdminController;

// Halaman login
Route::get('/login/admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/admin', [AdminController::class, 'login'])->name('admin.login.post');

// Admin Dashboard (Hanya bisa diakses jika sudah login sebagai admin)
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Landing page 
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Login User
Route::get('/login', function () {
    return view('login');
})->name('login');

// User Dashboard (Hanya bisa diakses jika sudah login sebagai user)
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user-dashboard');
});

// Admin Dashboard (Hanya bisa diakses jika sudah login sebagai admin)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin-dashboard');
});

// Halaman Registrasi
Route::get('/register-group', function () {
    return view('register-group');
})->name('register-group');
Route::get('/register-leader', function () {
    return view('register-leader');
})->name('register-leader');
Route::get('/register-member', function () {
    return view('register-member');
})->name('register-member');

// Middleware untuk user yang sudah login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

