@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit News</h1>
    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" required>{{ $news->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="cover_image">Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
            @if ($news->cover_image)
                <img src="{{ asset('storage/' . $news->cover_image) }}" alt="Cover Image" style="width: 150px; height: 150px;">
            @endif
        </div>
        <div class="form-group">
            <label for="published_at">Published At</label>
            <input type="date" name="published_at" class="form-control" value="{{ $news->published_at }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
