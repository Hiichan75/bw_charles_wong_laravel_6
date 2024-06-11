@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit FAQ</h1>
    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea name="answer" class="form-control">{{ $faq->answer }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($faq->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            <a href="{{ route('admin.faq_categories.create') }}" class="btn btn-link">Add New Category</a>
        </div>
        <button type="submit" class="btn btn-primary">Update FAQ</button>
    </form>
</div>
@endsection
