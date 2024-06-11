@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $contact->name }}</h2>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Message:</strong> {{ $contact->message }}</p>

    <form action="{{ route('admin.contact.reply', $contact->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="reply">Reply</label>
            <textarea name="reply" class="form-control" required>{{ $contact->reply }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Reply</button>
    </form>
</div>
@endsection
