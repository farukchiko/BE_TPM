<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;

Route::get('/', function () {
    return view('landing');
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

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/register-group', function () {
    return view('register-group');
})->name('register-group');

Route::get('/register-leader', function () {
    return view('register-leader');
})->name('register-leader');

Route::get('/register-member', function () {
    return view('register-member');
})->name('register-member');

Route::post('/register-member', [RegisterController::class, 'register']);
