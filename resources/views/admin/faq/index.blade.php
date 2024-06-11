@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Manage FAQs</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">Add FAQ</a>
            <a href="{{ route('admin.faq_categories.create') }}" class="btn btn-secondary">Add Category</a>
        </div>
    </div>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $faq)
                <tr>
                    <td>{{ $faq->question }}</td>
                    <td>{{ Str::limit($faq->answer, 50) }}</td>
                    <td>{{ $faq->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" style="display:inline;">
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
