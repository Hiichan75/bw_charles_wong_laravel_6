@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price:</strong> {{ $product->formatted_price }}</p> <!-- Correctly display the price -->
                        <a href="{{ route('order.create', ['product_id' => $product->id]) }}" class="btn btn-success">Order</a>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
