@extends('layouts.app')

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
            <p><strong>Status:</strong> {{ $order->status }}</p>
        </div>
    </div>
</div>
@endsection
