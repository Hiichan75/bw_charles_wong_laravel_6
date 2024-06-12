<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id)
    {
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

    public function edit($id)
    {
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

        // Retrieve the user or fail if it doesn't exist
        $user = User::findOrFail($id);

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

        // Update the user's name
        $user->update([
            'name' => $request->username
        ]);

        // Redirect back to the profile show page with a success message
        return redirect()->route('profile.show', $id)->with('success', 'Profile updated successfully!');
    }
}
