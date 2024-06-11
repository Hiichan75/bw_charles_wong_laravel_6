@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $profile->username }}'s Profile</h1>
    <img src="{{ $profile->avatar ? asset('storage/' . $profile->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" width="150">
    <p><strong>About Me:</strong> {{ $profile->about_me }}</p>
    <p><strong>Birthday:</strong> {{ $profile->birthday ? $profile->birthday->format('Y-m-d') : 'Not set' }}</p>
    <a href="{{ route('profile.edit', $profile->user_id) }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
