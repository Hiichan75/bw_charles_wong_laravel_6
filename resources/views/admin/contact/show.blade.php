@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $contact->name }}</h2>
    <p>{{ $contact->email }}</p>
    <p>{{ $contact->message }}</p>
    <form action="{{ route('admin.contact.reply', $contact->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="reply">Reply</label>
            <textarea name="reply" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Reply</button>
    </form>
</div>
@endsection
