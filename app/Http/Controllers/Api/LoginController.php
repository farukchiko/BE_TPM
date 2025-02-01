<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
    
        // Cari tim berdasarkan team_name
        $team = Team::where('team_name', $validated['team_name'])->first();
    
        if (!$team) {
            return response()->json(['message' => 'Invalid team name'], 404);
        }
    
        // Cari anggota dalam tim tersebut
        $member = Member::where('team_id', $team->id)->first();
    
        if (!$member) {
            return response()->json(['message' => 'No members found for this team'], 404);
        }
    
        // Validasi password
        if (!Hash::check($validated['password'], $member->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        // Generate token untuk member
        $token = $member->createToken('member-token')->plainTextToken;
    
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'member' => $member,
            'team' => $team,
        ], 200);
    }
    
    public function loginAdmin(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    $admin = User::where('email', $validated['email'])->where('is_admin', true)->first();

    if (!$admin || !Hash::check($validated['password'], $admin->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Generate token untuk admin
    $token = $admin->createToken('admin-token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'admin' => [
            'id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
        ],
    ], 200);
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
