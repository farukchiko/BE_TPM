<?php

use Illuminate\Support\Facades\Route;

// landing
Route::get('/', function () {
    return view('landing');
});

// login participant
Route::get('/login', function () {
    return view('login');
});

// login admin
Route::get('/login/admin', function () {
    return view('login-admin');
});

// register
Route::get('/register', function () {
    return view('register');
});

// admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// user dashboard
Route::get('/participant/dashboard', function () {
    return view('participant.dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
