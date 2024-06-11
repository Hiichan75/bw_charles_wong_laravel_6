@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Messages</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Message</th>
                <th>Reply</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->reply ?? 'No reply yet' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
