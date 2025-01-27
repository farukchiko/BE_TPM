<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin_GetTeamDetails extends Controller
{
    public function show(Request $request, $team_id)
    {   
        /*
        
        TEAM                : id, name, regist time, member
        MEMBER              : [EACH] id, name, email, is_leader, regist time
        is_leader === TRUE  : id, name, email, is_leader, regist time
        
        */
        $team = Team::findOrFail($team_id);
        $leader = $team->members()->where('is_leader', true)->first();
        $members = $team->members()->get();

        $membersData = $members->map(function ($member) {
            return [
                'member_id' => $member->id,
                'name' => $member->name,
                'email' => $member->email,
                'is_leader' => $member->is_leader ? true: false,
                'regist_time' => $member->created_at,
            ];
        });

        $leaderData = $leader ? [
                'leader_id' => $leader->id,
                'name' => $leader->name,
                'email' => $leader->email,
                'is_leader' => $leader->is_leader ? true: false,
                'regist_time' => $leader->created_at,
            ] : null;   
        
        $data = [
            'team_id' => $team->id,
            'name' => $team->team_name,
            'regist_time' => $team->created_at,
            'members' => $membersData,
            'leader' => $leaderData
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }
        return view('admin.dashboard.detail', $data);
    }
}
