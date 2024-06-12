@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-header">
            Order #{{ $order->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Customer Details</h5>
            <p><strong>First Name:</strong> {{ $order->first_name }}</p>
            <p><strong>Last Name:</strong> {{ $order->last_name }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Country:</strong> {{ $order->country }}</p>

            <h5 class="card-title">Order Items</h5>
            <ul>
                @foreach ($order->items as $item)
                <li>{{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: €{{ number_format($item->price, 2) }}</li>
                @endforeach
            </ul>

            <h5 class="card-title">Order Status</h5>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p> <!-- Display the current status 
                                                                               disable status update 
            <h5 class="card-title">Update Status</h5>
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" class="form-control mb-3" onchange="this.form.submit()">
                    <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                    <option value="complete" @if($order->status == 'complete') selected @endif>Complete</option>
                    <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                </select>
            </form>
            -->
        </div>
    </div>
</div>
@endsection