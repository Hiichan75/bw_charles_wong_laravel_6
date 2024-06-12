@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>€{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                <option value="completed" @if($order->status == 'completed') selected @endif>Completed</option>
                                <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
