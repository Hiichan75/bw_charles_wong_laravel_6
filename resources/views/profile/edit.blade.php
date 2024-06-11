@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update', $profile->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $profile->username) }}" required>
        </div>

        <div class="form-group">
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" class="form-control" value="{{ old('birthday', $profile->birthday ? $profile->birthday->format('Y-m-d') : '') }}">
        </div>

        <div class="form-group">
            <label for="about_me">About Me:</label>
            <textarea id="about_me" name="about_me" class="form-control">{{ old('about_me', $profile->about_me) }}</textarea>
        </div>

        <div class="form-group">
            <label for="avatar">Avatar:</label>
            <input type="file" id="avatar" name="avatar" class="form-control">
            @if ($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Current Avatar" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Save Changes</button>
    </form>
</div>
@endsection
