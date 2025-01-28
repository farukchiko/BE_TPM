<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\User_DashboardController;
use App\Http\Controllers\Api\Admin_GetAllTeams;
use App\Http\Controllers\Api\Admin_GetTeamDetails;
use App\Http\Controllers\Api\Admin_EditTeam;
use App\Http\Controllers\Api\AdminDeleteTeam;
use App\Http\Controllers\Api\ContactController;
use Illuminate\Http\Request;

// Public routes
Route::post('/register-user', [RegisterController::class, 'register']);
Route::post('/login-user', [LoginController::class, 'loginUser']);
Route::post('/login-admin', [LoginController::class, 'loginAdmin']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
 // Route untuk contact
 Route::post('/contact', [ContactController::class, 'store']);

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

        // Get Team Details
        Route:: get('/admin-dashboard/get-team-details/{teamId}', [Admin_GetTeamDetails::class, 'show'])->name('admin.dashboard.detail');
        
        //rute ini hanya akan mengembalikan pesan selamat datang (welcome message) saat mengetes token admin
        Route::get('/admin/dashboard', function () {
            return response()->json(['message' => 'Welcome to Admin Dashboard']);
        });
        // Route untuk mengupdate tim
        Route::put('/admin/edit-team/{teamId}', [Admin_EditTeam::class, 'update'])->name('admin.edit-team');

        // Route untuk menghapus tim
        Route::delete('/admin/delete-teams/{id}', [AdminDeleteTeam::class, 'destroy']);

    });
});
