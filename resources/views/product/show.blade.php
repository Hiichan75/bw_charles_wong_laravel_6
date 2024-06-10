@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width: 150px; height: 150px;">
    @endif
    <form action="{{ route('order.create', $product->id) }}" method="GET">
        <button type="submit" class="btn btn-primary">Order Now</button>
    </form>
</div>
@endsection
