@extends('layouts.admin')

@section('content')
<div class="container">
    <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">Add FAQ</a>
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td>{{ $faq->category->name }}</td>
                <td>
                    <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" style="display:inline;">
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
