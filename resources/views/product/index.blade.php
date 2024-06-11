@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
    @foreach($products as $product)
        <div>
            <h2><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h2>
            <p>{{ $product->description }}</p>
            <p>Price: €{{ $product->price }}</p>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width: 150px; height: 150px;">
            @endif
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
