<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;
use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//NANTI KLO UDH JADI FRONT-ENDNYA, FILE PATHNYA DISESUAIKAN LAGI

class User_DashboardController extends Controller
{
    public function show(Request $request, $team_id)
    {
        $team = Team::findOrFail($team_id);
        $files = File::where('team_id', $team_id)->get();
        $leader = $team->members()->where('is_leader', true)->first();
        $members = $team->members()->where('is_leader', false)->get();
        
        $cvUrl = '';
        $CardUrl = '';
        
        foreach ($files as $file) {
            if ($file->file_name === 'CV') {
                $cvUrl = asset('public/storage/' . $file->file_path);
            }
        
            if ($file->file_name === 'ID CARD') {
                $CardUrl = asset('public/storage/' . $file->file_path);
            }
            else{
                $CardUrl = asset('public/storage/' . $file->file_path);
            }
            
        }

        $data = [
            'team_name' => $team->team_name,
            'leader' => [
                'name' => $leader->name,
                'email' => $leader->email,
                'phone' => $leader->phone,
                'line_id' => $leader->line_id,
                'github_id' => $leader->github_id,
                'birth_place' => $leader->birth_place,
                'birth_date' => $leader->birth_date,
            ],

            'members' => $members->map(function ($member) {
                return [
                    'name' => $member->name,
                    'email' => $member->email,
                ];
            }),

            'cv_url' => $cvUrl,
            'id_card_or_flazz_url' => $CardUrl
        ];
        

        if ($request->wantsJson()) {
            return response()->json($data);
        }
        return view('user.dashboard', $data);
    }
}
