<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class AdminDeleteTeam extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $team = Team::findOrFail($id);
            
            // Hapus semua member terkait
            $team->members()->delete();
            
            // Hapus team
            $team->delete();

            return response()->json([
                'message' => 'Team deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Team not found.'
            ], 404);
        }
    }
}
