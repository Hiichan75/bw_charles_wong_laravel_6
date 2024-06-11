@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('news.create') }}" class="btn btn-primary">Create News</a>
        @endif
    @endauth
    @foreach($news as $newsItem)
        <div>
            <h2>{{ $newsItem->title }}</h2>
            @if ($newsItem->cover_image)
                <img src="{{ asset('storage/' . $newsItem->cover_image) }}" alt="Cover Image" style="width: 150px; height: 150px;">
            @endif
            <p>{{ $newsItem->content }}</p>
            <p>Published at: {{ $newsItem->published_at }}</p>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('news.edit', $newsItem->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach
</div>
@endsection
