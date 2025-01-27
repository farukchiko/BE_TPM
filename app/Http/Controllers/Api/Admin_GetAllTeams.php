<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin_GetAllTeams extends Controller
{
    //id, team_name, regist date, leader name, members count 

    public function show(Request $request)
    {   
        $teams = Team::all();
        $teamsData = $teams->map(function ($team) {
            $leader = $team->members()->where('is_leader', true)->first();
            $members = $team->members()->where('is_leader', false)->get();
            $countMember = $members->count();

            $membersData = $members->map(function ($member) {
                return [
                    'name' => $member->name,
                    'email' => $member->email,
                ];
            });

            return [
                'id' => $team->id,
                'team_name' => $team->team_name,
                'leader_name' => $leader,
                'members_count' => $countMember,
                'members' => $membersData
            ];
        }); 
        
        $data = [
            'teams' => $teamsData
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }
        return view('admin.dashboard', $data);
    }
}
