<!-- resources/views/admin/forum/index.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Forum Posts</h1>
    @foreach($posts as $post)
        <div class="post mb-4">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p><strong>Posted by:</strong> {{ $post->user->name }}</p>

            <!-- Edit and Delete buttons -->
            <a href="{{ route('admin.forum.edit', $post->id) }}" class="btn btn-secondary btn-sm">Edit</a>
            <form action="{{ route('admin.forum.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>

            <!-- List of replies -->
            <div class="replies mt-3">
                <h4>Replies</h4>
                @foreach($post->replies as $reply)
                    <div class="reply p-2 border mb-2">
                        <p>{{ $reply->content }}</p>
                        <p><small>Reply by: {{ $reply->user->name }}</small></p>
                        <form action="{{ route('admin.forum.reply.destroy', $reply->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete Reply</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
