@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="container">
    <h1>Manage Users</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create New User</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Admin Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('admin.users.updateAdminStatus', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        @if($user->email === 'admin@ehb.be')
                            <select name="is_admin" disabled>
                                <option value="yes" selected>Yes</option>
                            </select>
                        @else
                            <select name="is_admin" onchange="this.form.submit()">
                                <option value="no" {{ !$user->is_admin ? 'selected' : '' }}>No</option>
                                <option value="yes" {{ $user->is_admin ? 'selected' : '' }}>Yes</option>
                            </select>
                        @endif
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        @if($user->email === 'admin@ehb.be')
                            <button type="submit" class="btn btn-danger btn-sm" disabled>Delete</button>
                        @else
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        @endif
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
