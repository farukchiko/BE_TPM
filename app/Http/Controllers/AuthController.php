<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'password' => 'required|string|min:6|confirmed',
            'leader.name' => 'required|string|max:255',
            'leader.email' => 'required|string|email|max:255|unique:members,email',
            'leader.phone' => 'required|string|max:15',
            'leader.line_id' => 'nullable|string|max:255',
            'leader.github_id' => 'nullable|string|max:255',
            'leader.birth_place' => 'nullable|string|max:255',
            'leader.birth_date' => 'nullable|date',
            'members' => 'array',
            'members.*.name' => 'required_with:members|string|max:255',
            'members.*.email' => 'required_with:members|string|email|max:255|unique:members,email',
            'files.cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Validasi file CV
            'files.id_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file ID Card
            'is_binusian' => 'required|boolean',
        ]);

        $team = Team::create([
            'name' => $request->team_name,
        ]);

        $leader = Member::create([
            'team_id' => $team->id,
            'name' => $request->leader['name'],
            'email' => $request->leader['email'],
            'phone' => $request->leader['phone'],
            'line_id' => $request->leader['line_id'],
            'github_id' => $request->leader['github_id'],
            'birth_place' => $request->leader['birth_place'],
            'birth_date' => $request->leader['birth_date'],
            'is_leader' => true,
            'password' => Hash::make($request->password),
            'is_binusian' => $request->is_binusian,
        ]);

        if ($request->has('members')) {
            foreach ($request->members as $member) {
                Member::create([
                    'team_id' => $team->id,
                    'name' => $member['name'],
                    'email' => $member['email'],
                    'password' => null,
                ]);
            }
        }

        if ($request->hasFile('files.cv')) {
            $cvPath = $request->file('files.cv')->store('cv_files', ['disk' => 'public']);
            $team->cv_file = $cvPath;
        }

        if ($request->hasFile('files.id_card')) {
            $idCardPath = $request->file('files.id_card')->store('id_card_files', ['disk' => 'public']);
            $team->id_card_file = $idCardPath;
        }

        $team->save();

        return response()->json(['message' => "Team and members registered successfully"], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_or_team_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (filter_var($request->email_or_team_name, FILTER_VALIDATE_EMAIL)) {
            $admin = Member::where('email', $request->email_or_team_name)->where('is_leader', true)->first();

            if (!$admin || !Hash::check($request->password, $admin->password)) {
                return response()->json(['message' => "Invalid email or password"], 401);
            }

            $admin->api_token = Str::random(80);
            $admin->save();

            return response()->json([
                "message" => "Admin login successful",
                "token" => $admin->api_token,
                "role" => "admin"
            ]);
        } else {
            $team = Team::where('name', $request->email_or_team_name)->first();

            if (!$team) {
                return response()->json(['message' => "Team not found"], 404);
            }

            $member = Member::where('team_id', $team->id)->whereNotNull('password')->first();

            if (!$member || !Hash::check($request->password, $member->password)) {
                return response()->json(['message' => "Invalid team name or password"], 401);
            }

            $member->api_token = Str::random(80);
            $member->save();

            return response()->json([
                "message" => "User login successful",
                "token" => $member->api_token,
                "role" => "user",
                "team" => $team->name
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = Member::where('api_token', $request->bearerToken())->first();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['message' => "Logged out successfully"]);
    }
}
