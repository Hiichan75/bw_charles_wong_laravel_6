<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show profile
    public function show($id)
    {
        // Check if the user exists
        $user = User::find($id);
        if (!$user) {
            // If user doesn't exist, redirect to the authenticated user's profile with an error message
            return redirect()->route('profile.show', Auth::id())->with('error', 'The requested user does not exist.');
        }

        // Retrieve the user's profile or create it if it doesn't exist
        $profile = Profile::firstOrCreate(
            ['user_id' => $id],
            [
                'username' => Auth::user()->name, // Use registered username
                'about_me' => 'Tell us about yourself',
                'avatar' => null
            ]
        );

        return view('profile.show', compact('profile'));
    }

    // Edit profile
    public function edit($id)
    {
        // Check if the user exists
        $user = User::find($id);
        if (!$user) {
            // If user doesn't exist, redirect to the authenticated user's profile with an error message
            return redirect()->route('profile.show', Auth::id())->with('error', 'The requested user does not exist.');
        }

        // Retrieve the user's profile or create it if it doesn't exist
        $profile = Profile::firstOrCreate(
            ['user_id' => $id],
            [
                'username' => Auth::user()->name, // Use registered username
                'about_me' => 'Tell us about yourself',
                'avatar' => null
            ]
        );

        return view('profile.edit', compact('profile'));
    }

    // Update profile
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string|max:255|unique:users,name,' . $id,
            'birthday' => 'nullable|date',
            'about_me' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Retrieve the profile or fail if it doesn't exist
        $profile = Profile::where('user_id', $id)->firstOrFail();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        // Update the profile with the new data
        $profile->update([
            'username' => $request->username,
            'birthday' => $request->birthday,
            'about_me' => $request->about_me,
            'avatar' => $profile->avatar
        ]);

        // Redirect back to the profile show page with a success message
        return redirect()->route('profile.show', $id)->with('success', 'Profile updated successfully!');
    }
}
