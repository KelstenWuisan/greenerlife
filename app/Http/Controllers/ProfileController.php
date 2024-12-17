<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function edit()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        $title = 'Edit Profile';
        // Tampilkan form edit dengan data pengguna
        return view('profile', compact('user', 'title'));
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:8',
            'age' => 'nullable|integer',
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048',  // Validate image size
        ]);

        // Get the currently logged-in user
        $user = Auth::user();

        // Update user name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Update age and bio
        $user->age = $request->input('age');
        $user->bio = $request->input('bio');

        // Update profile picture if a new file is uploaded
        if ($request->hasFile('profile_picture')) {
            // Check if the user has a profile picture and delete the old one
            if ($user->profile_picture && file_exists(public_path('storage/' . $user->profile_picture))) {
                unlink(public_path('storage/' . $user->profile_picture));  // Delete the old image
            }

            // Store the new profile picture
            $fileName = Str::random(10) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = $request->file('profile_picture')->storeAs('profile-pictures', $fileName, 'public');
            $user->profile_picture = $path;  // Store the new image path in the database
        }

        // Save the updated user data
        $user->save();

        // Redirect back with success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
