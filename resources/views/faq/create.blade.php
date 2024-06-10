@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('faq.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" class="form-control">
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea name="answer" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add FAQ</button>
    </form>
</div>
@endsection
