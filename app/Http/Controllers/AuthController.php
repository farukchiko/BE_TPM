<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'is_binusian' => 'required|boolean',
            'leader_name' => 'required|string|max:255',
            'leader_email' => 'required|string|email|max:255|unique:members,email',
            'leader_password' => 'required|string|min:6',
            'members' => 'array',
            'members.*.name' => 'required_with:members|string|max:255',
            'members.*.email' => 'required_with:members|string|email|max:255|unique:members,email',
        ]);

        // Membuat tim
        $team = Team::create([
            'name' => $request->team_name,
            'institution' => $request->institution,
            'is_binusian' => $request->is_binusian,
        ]);

        // Menambahkan leader
        $leader = Member::create([
            'team_id' => $team->id,
            'name' => $request->leader_name,
            'email' => $request->leader_email,
            'is_leader' => true,
        ]);

        // Menambahkan anggota tim (jika ada)
        if ($request->has('members')) {
            foreach ($request->members as $member) {
                Member::create([
                    'team_id' => $team->id,
                    'name' => $member['name'],
                    'email' => $member['email'],
                ]);
            }
        }

        return response()->json(['message' => 'Team and members registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $leader = Member::where('email', $request->email)->where('is_leader', true)->first();

        if (!$leader || !Hash::check($request->password, $leader->password)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        // Generate Bearer Token
        $leader->api_token = Str::random(80);
        $leader->save();

        return response()->json([
            'message' => 'Login successful',
            'token' => $leader->api_token,
        ]);
    }

    public function logout(Request $request)
    {
        $leader = Member::where('api_token', $request->bearerToken())->first();

        if ($leader) {
            $leader->api_token = null;
            $leader->save();
        }

        return response()->json(['message' => 'Logged out successfully']);
    }
}
