@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('forum.create') }}" class="btn btn-primary">Create Post</a>
    @foreach($posts as $post)
        <div>
            <h2><a href="{{ route('forum.show', $post->id) }}">{{ $post->title }}</a></h2>
            <p>{{ $post->content }}</p>
            <p>Posted by: {{ $post->user->name }}</p>
        </div>
    @endforeach
</div>
@endsection
