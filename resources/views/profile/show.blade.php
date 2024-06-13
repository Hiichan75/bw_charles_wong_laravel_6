@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $profile->username }}'s Profile</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <p><strong>About Me:</strong> {{ $profile->about_me }}</p>
    <p><strong>Birthday:</strong> {{ $profile->birthday ? $profile->birthday->format('d/m/Y') : 'Not set' }}</p>
    <img src="{{ $profile->avatar ? asset('storage/' . $profile->avatar) : 'default-avatar.png' }}" alt="Avatar" width="150">
    <!-- Add other profile details here -->
    @if (Auth::id() == $profile->user_id || Auth::user()->is_admin)
        <a href="{{ route('profile.edit', $profile->user_id) }}" class="btn btn-primary mt-3">Edit Profile</a>
    @endif
</div>
@endsection
