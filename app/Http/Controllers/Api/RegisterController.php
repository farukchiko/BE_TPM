<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Pastikan Hash diimpor
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'team_name' => 'required|string|max:255',
                'is_binusian' => 'required|boolean',
                'password' => 'required|confirmed|min:6',
                'leader.name' => 'required|string|max:255',
                'leader.email' => 'required|email|unique:members,email',
                'leader.phone' => 'nullable|string|max:20',
                'leader.line_id' => 'nullable|string|max:50',
                'leader.github_id' => 'nullable|string|max:50',
                'leader.birth_place' => 'nullable|string|max:100',
                'leader.birth_date' => 'nullable|date',
                'members.*.name' => 'required|string|max:255',
                'members.*.email' => 'required|email|unique:members,email',
                'files.cv' => 'required|file|mimes:pdf|max:2048',
                'files.id_card' => 'required|file|mimes:jpg,png,pdf|max:2048',
            ]);

            // Simpan tim
            $team = Team::create([
                'team_name' => $validated['team_name'],
                'is_binusian' => $validated['is_binusian'],
            ]);

            Log::info('Team created:', $team->toArray());

            // Tambahkan leader dengan password yang di-hash
            $leader = Member::create(array_merge($validated['leader'], [
                'team_id' => $team->id,
                'is_leader' => true,
                'password' => Hash::make($validated['password']), // Hash password sebelum menyimpan
            ]));

            Log::info('Leader created:', $leader->toArray());

            // Tambahkan anggota tim dengan password yang di-hash
            foreach ($validated['members'] as $member) {
                $newMember = Member::create(array_merge($member, [
                    'team_id' => $team->id,
                    'password' => Hash::make($validated['password']), // Hash password sebelum menyimpan
                ]));
                Log::info('Member created:', $newMember->toArray());
            }

            // Simpan file
            $cvPath = $request->file('files.cv')->store('uploads/cv');
            $idCardPath = $request->file('files.id_card')->store('uploads/id_card');

            $cvFile = File::create([
                'team_id' => $team->id,
                'file_name' => 'CV',
                'file_path' => $cvPath,
            ]);
            $idCardFile = File::create([
                'team_id' => $team->id,
                'file_name' => 'ID Card',
                'file_path' => $idCardPath,
            ]);

            Log::info('Files created:', [
                'cv' => $cvFile->toArray(),
                'id_card' => $idCardFile->toArray(),
            ]);

            return response()->json(['message' => 'Team registered successfully'], 201);
        } catch (\Exception $e) {
            Log::error('Error during registration:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }
}
