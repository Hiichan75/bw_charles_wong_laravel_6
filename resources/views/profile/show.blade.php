@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $profile->username }}</h1>
    <p>Birthday: {{ $profile->birthday }}</p>
    @if ($profile->avatar)
        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" style="width: 150px; height: 150px;">
    @endif
    <p>About Me: {{ $profile->about_me }}</p>
</div>
@endsection
