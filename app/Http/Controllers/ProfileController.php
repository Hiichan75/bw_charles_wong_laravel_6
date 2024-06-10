<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show($id)
{
    $profile = Profile::where('user_id', $id)->firstOrFail();
    return view('profile.show', compact('profile'));
}

public function edit($id)
{
    $profile = Profile::where('user_id', $id)->firstOrFail();
    return view('profile.edit', compact('profile'));
}

public function update(Request $request, $id)
{
    $profile = Profile::where('user_id', $id)->firstOrFail();
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $profile->avatar = $path;
    }
    $profile->update($request->except('avatar'));
    return redirect()->route('profile.show', $id);
}

}
