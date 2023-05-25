<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coaches;

class CoachController extends Controller
{
    public function index(Request $request) {
        $coachs = Coaches::all();
        return response()->json([
            'message' => 'success',
            'coaches'=> $coachs
        ]);
    }
    public function show(string $id) {
        return response()->json([
            'message' => 'success',
            'coach'=> Coaches::findOrFail($id)
        ]);
    }
    public function store(Request $request) {
        $request->validate([
            'coachId' => 'required|integer|unique:coaches',
            'name' => 'required|string',
            'hourlyRate' => 'required|string',
            'description' => 'required|string',
            'areas' => 'required',
        ]);

        $coach = Coaches::create([
            'coachId' => $request->coachId,
            'name' => $request->name,
            'hourlyRate' => $request->hourlyRate,
            'description' => $request->description,
            'areas' => json_encode($request->areas),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Coaches created successfully',
            'user' => $coach,
        ]);
    }
}
