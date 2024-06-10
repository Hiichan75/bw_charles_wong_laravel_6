@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    <p>Posted by: {{ $post->user->name }}</p>

    <h3>Replies</h3>
    @foreach($post->replies as $reply)
        <div>
            <p>{{ $reply->content }}</p>
            <p>Replied by: {{ $reply->user->name }}</p>
        </div>
    @endforeach

    <form action="{{ route('forum.storeReply', $post->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Reply</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Reply</button>
    </form>
</div>
@endsection
