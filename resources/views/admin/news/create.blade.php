@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create News</h1>
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="cover_image">Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
        </div>
        <!--  <div class="form-group">
            <label for="published_at">Published At</label>
            <input type="date" name="published_at" class="form-control" required>
        </div> -->
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
