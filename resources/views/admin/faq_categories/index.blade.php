@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Manage FAQ Categories</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <a href="{{ route('admin.faq_categories.create') }}" class="btn btn-primary mb-3 mr-2">Add Category</a>
            <a href="{{ route('admin.faq.create') }}" class="btn btn-secondary mb-3">Add FAQ</a>
        </div>
    </div>
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
                        <a href="{{ route('admin.faq_categories.edit', $category->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('admin.faq_categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
