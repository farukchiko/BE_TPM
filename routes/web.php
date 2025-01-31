<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;

// landing
Route::get('/', function () {
    return view('landing');
})->name('landing');

// login participant
Route::get('/login', function () {
    return view('login');
})->name('login');

// login admin
Route::get('/login/admin', function () {
    return view('login-admin');
})->name('login-admin');

// admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin-dashboard');

// user dashboard
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user-dashboard');

// edwin
Route::get('/register-group', function () {
    return view('register-group');
})->name('register-group');

Route::get('/register-leader', function () {
    return view('register-leader');
})->name('register-leader');

Route::get('/register-member', function () {
    return view('register-member');
})->name('register-member');
