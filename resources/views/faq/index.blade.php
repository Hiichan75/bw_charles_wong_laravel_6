@extends('layouts.app')

@section('content')
<div class="container">
    
    @foreach($categories as $category)
        <div>
            <h2>{{ $category->name }}</h2>
            @foreach($category->faqs as $faq)
                <div>
                    <h4>{{ $faq->question }}</h4>
                    <p>{{ $faq->answer }}</p>
                    <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
