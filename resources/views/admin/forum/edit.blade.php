<!-- resources/views/admin/forum/edit.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Forum Post</h1>
    <form action="{{ route('admin.forum.update', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
