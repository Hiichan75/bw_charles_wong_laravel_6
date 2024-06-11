@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Total Price: €{{ number_format($order->total_price, 2, ',', '.') }}</p>
    <p>Status: {{ $order->status }}</p>
    <h2>Items</h2>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} x €{{ number_format($item->price, 2, ',', '.') }}</li>
        @endforeach
    </ul>
</div>
@endsection
