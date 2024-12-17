<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $topUsers = User::orderBy('points', 'desc')->take(3)->get();
        $challenges = Challenge::paginate(7);

        return view('challenges', compact('challenges', 'topUsers'), ['title' => 'Challenges']);
    }

    public function submitProof(Request $request)
    {
        $request->validate([
            'challenge_id' => 'required|exists:challenges,id',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = auth()->user();
        $challenge = Challenge::findOrFail($request->challenge_id);

        if ($user->completedChallenges->contains($challenge)) {
            return redirect()->back()->with('error', 'You have already completed this challenge.');
        }

        $filePath = $request->file('proof')->store('proofs', 'public');

        $user->challenges()->attach($challenge, ['proof' => $filePath, 'completed' => true]);
        $user->increment('points', $challenge->points);

        return redirect()->back()->with('success', 'Challenge completed! Points have been added to your account.');
    }
}
