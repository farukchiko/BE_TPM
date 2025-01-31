<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Member;
use App\Models\File;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teams = Team::with(['members', 'files'])->get();

        return view('admin.dashboard', compact('teams'));
    }
}

