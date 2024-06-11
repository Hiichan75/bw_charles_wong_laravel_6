@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add Category</h1>
    <form action="{{ route('admin.faq_categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>
@endsection
