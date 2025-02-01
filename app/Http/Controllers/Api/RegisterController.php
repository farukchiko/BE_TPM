<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'], // Password harus mengandung huruf kecil, huruf besar, angka, dan karakter khusus
                'leader.name' => 'required|string|max:255',
                'leader.email' => 'required|email|unique:members,email',
                'leader.phone' => 'nullable|string|min:9|unique:members,phone',
                'leader.line_id' => 'nullable|string|max:50|unique:members,line_id',
                'leader.github_id' => 'nullable|string|max:50',
                'leader.birth_place' => 'nullable|string|max:100',
                'leader.birth_date' => 'nullable|date',
                'members.*.name' => 'required|string|max:255',
                'members.*.email' => 'required|email|unique:members,email',
                'files.cv' => 'required|file|mimes:pdf|max:2048',

                // id card for non binusian
                'files.id_card' => 'sometimes|required_if:is_binusian,0|file|mimes:jpg,png,pdf|max:2048',

                // flazz for binusian
                'files.flazz_card' => 'sometimes|required_if:is_binusian,1|file|mimes:jpg,png,pdf|max:2048',
            ]);

            // save tim
            $team = Team::create([
                'team_name' => $validated['team_name'],
                'is_binusian' => $validated['is_binusian'],
            ]);

            Log::info('Team created:', $team->toArray());

            // leader
            $leader = Member::create(array_merge($validated['leader'], [
                'team_id' => $team->id,
                'is_leader' => true,
                'password' => Hash::make($validated['password']), 
            ]));

            Log::info('Leader created:', $leader->toArray());

            // member
            foreach ($validated['members'] as $member) {
                $newMember = Member::create(array_merge($member, [
                    'team_id' => $team->id,
                    'password' => Hash::make($validated['password']), 
                ]));
                Log::info('Member created:', $newMember->toArray());
            }

            // save cv
            $cvPath = $request->file('files.cv')->store('uploads/cv');
            $cvFile = File::create([
                'team_id' => $team->id,
                'file_name' => 'CV',
                'file_path' => $cvPath,
            ]);

            // save id card
            if ($validated['is_binusian'] == 0 && $request->hasFile('files.id_card')) {
                $idCardPath = $request->file('files.id_card')->store('uploads/id_card');
                $idCardFile = File::create([
                    'team_id' => $team->id,
                    'file_name' => 'ID Card',
                    'file_path' => $idCardPath,
                ]);
                Log::info('ID Card saved:', $idCardFile->toArray());
            }

            // save flazz
            if ($validated['is_binusian'] == 1 && $request->hasFile('files.flazz_card')) {
                $flazzCardPath = $request->file('files.flazz_card')->store('uploads/flazz_card');
                $flazzCardFile = File::create([
                    'team_id' => $team->id,
                    'file_name' => 'Flazz Card',
                    'file_path' => $flazzCardPath,
                ]);
                Log::info('Flazz Card saved:', $flazzCardFile->toArray());
            }

            return response()->json([
                'message' => 'Team registered successfully',
                'team_id' => $team -> id], 201);
        } catch (\Exception $e) {
            Log::error('Error during registration:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }
}
