<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;

class Admin_EditTeam extends Controller
{
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'team_name' => 'required|string',
            'leader.name' => 'required|string',
            'leader.email' => 'required|email',
            'members.*.name' => 'required|string',
            'members.*.email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update team
        $team = Team::findOrFail($id);
        $team->update([
            'team_name' => $request->team_name
        ]);

        // Update or create leader
        $leader = Member::updateOrCreate(
            [
                'team_id' => $team->id,
                'is_leader' => true
            ],
            [
                'name' => $request->leader['name'],
                'email' => $request->leader['email']
            ]
        );

        // Ambil email dari request members
        $requestMemberEmails = collect($request->members)->pluck('email');

        // Perbarui atau buat anggota baru
        foreach ($request->members as $memberData) {
            Member::updateOrCreate(
                [
                    'team_id' => $team->id,
                    'email' => $memberData['email'], // Cari berdasarkan email
                ],
                [
                    'name' => $memberData['name'],   // Update nama
                    'is_leader' => false            // Pastikan bukan leader
                ]
            );
        }

        // Hapus anggota lama yang tidak ada di request
        Member::where('team_id', $team->id)
            ->where('is_leader', false) // Jangan hapus leader
            ->whereNotIn('email', $requestMemberEmails)
            ->delete();

        // Muat ulang data tim beserta anggotanya
        $team->load('members');

        return response()->json([
            'success' => true,
            'message' => 'Team berhasil diperbarui',
            'data' => $team
        ], 200);
    }
}
