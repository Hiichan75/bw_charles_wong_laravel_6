@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Contacts</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Contact ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ Str::limit($contact->message, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.contact.show', $contact->id) }}" class="btn btn-primary btn-sm">View</a>
                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
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
