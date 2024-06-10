@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage News</h1>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Add News</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Published At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $newsItem)
                <tr>
                    <td>{{ $newsItem->title }}</td>
                    <td>{{ Str::limit($newsItem->content, 50) }}</td>
                    <td>{{ $newsItem->published_at }}</td>
                    <td>
                        <a href="{{ route('admin.news.edit', $newsItem->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('admin.news.destroy', $newsItem->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
