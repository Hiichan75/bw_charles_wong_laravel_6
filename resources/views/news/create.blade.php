@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="cover_image">Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="published_at">Publishing Date</label>
            <input type="date" name="published_at" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Publish</button>
    </form>
</div>
@endsection
