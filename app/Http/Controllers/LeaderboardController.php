<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Challenge;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function submitProof(Request $request, $id)
    {
        $request->validate([
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Save the proof file
        $filePath = $request->file('proof')->store('proofs', 'public');

        // Get the current user and challenge
        $user = auth()->user();
        $challenge = Challenge::findOrFail($id);

        // Check if user has already completed the challenge
        if ($user->challenges->contains($challenge)) {
            return back()->with('error', 'You have already completed this challenge.');
        }

        // Attach challenge to the user with proof and update points
        $user->challenges()->attach($challenge, ['proof' => $filePath]);
        $user->points += $challenge->points;
        $user->save();

        return redirect()->back()->with('success', 'Challenge completed! Points have been added to your account.');
    }
}


