@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Orders</h1>
    <ul>
        @foreach ($orders as $order)
            <li>
                <a href="{{ route('order.show', $order->id) }}">Order #{{ $order->id }} - Total: €{{ number_format($order->total_price, 2, ',', '.') }} - Status: {{ $order->status }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
