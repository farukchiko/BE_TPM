<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\User_DashboardController;
use App\Http\Controllers\AdminDeleteTeam;

// landing
Route::get('/', function () {
    return view('landing');
})->name('landing');

// register
Route::get('/register-group', function () {
    return view('register-group');
})->name('register-group');

Route::get('/register-leader', function () {
    return view('register-leader');
})->name('register-leader');

Route::get('/register-member', function () {
    return view('register-member');
})->name('register-member');

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
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::delete('/teams/{team}', [AdminDeleteTeam::class, 'destroy'])->name('teams.destroy'); //delete

// user dashboard
Route::get('/user/dashboard/{teamId}', [User_DashboardController::class, 'show'])->name('user.dashboard');
