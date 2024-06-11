@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('forum.create') }}" class="btn btn-primary">Create Post</a>
    </div>
    @foreach($posts as $post)
        <div class="post mb-4">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p><strong>Posted by:</strong> {{ $post->user->name }}</p>

            <!-- Reply Button -->
            <button class="btn btn-secondary btn-sm toggle-replies" data-post-id="{{ $post->id }}">View Replies</button>

            <!-- Replies Container -->
            <div class="replies mt-3" id="replies-{{ $post->id }}" style="display: none;">
                @foreach($post->replies as $reply)
                    <div class="reply p-2 border mb-2">
                        <p>{{ $reply->content }}</p>
                        <p><small>Reply by: {{ $reply->user->name }}</small></p>
                    </div>
                @endforeach

                <!-- Reply Form -->
                <form action="{{ route('forum.reply', $post->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="reply" class="form-control" rows="2" placeholder="Write your reply..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-replies').forEach(function (button) {
        button.addEventListener('click', function () {
            var postId = this.getAttribute('data-post-id');
            var repliesDiv = document.getElementById('replies-' + postId);
            if (repliesDiv.style.display === 'none') {
                repliesDiv.style.display = 'block';
                this.textContent = 'Hide Replies';
            } else {
                repliesDiv.style.display = 'none';
                this.textContent = 'View Replies';
            }
        });
    });
});
</script>
@endsection
