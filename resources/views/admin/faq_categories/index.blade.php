@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage FAQ Categories</h1>
    <a href="{{ route('admin.faq_categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('admin.faq_categories.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('admin.faq_categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
