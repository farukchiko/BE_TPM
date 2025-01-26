<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\User_DashboardController;
use App\Http\Controllers\Api\Admin_GetAllTeams;

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
    
    //Route untuk Dashboard User (View Data Tim dan File)
    Route::get('/user/dashboard/{userId}', [User_DashboardController::class, 'show'])->name('user.dashboard');
    
    
    // Route khusus admin
    Route::middleware('admin')->group(function () {
        //Get All Teams
        Route:: get('/admin-dashboard/get-all-teams', [Admin_GetAllTeams::class, 'show'])->name('admin.dashboard');
        
        //gtw ini buat apa wkwkwk @faruk
        Route::get('/admin/dashboard', function () {
            return response()->json(['message' => 'Welcome to Admin Dashboard']);
        });
    });
});
