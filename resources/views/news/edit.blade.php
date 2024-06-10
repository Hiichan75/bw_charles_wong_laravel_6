@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $news->title }}">
        </div>
        <div class="form-group">
            <label for="cover_image">Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control">{{ $news->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="published_at">Publishing Date</label>
            <input type="date" name="published_at" class="form-control" value="{{ $news->published_at }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
