@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('forum.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
</div>
@endsection
