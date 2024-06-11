@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Place Order</h1>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product">Product</label>
            @foreach ($products as $productItem)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="product_ids[]" value="{{ $productItem->id }}"
                           @if (isset($product) && $product->id == $productItem->id) checked @endif>
                    <label class="form-check-label">
                        {{ $productItem->name }} ({{ $productItem->formatted_price }})
                    </label>
                    <input class="form-control mt-2" type="number" name="quantities[]" min="1" placeholder="Quantity"
                           @if (isset($product) && $product->id == $productItem->id) value="1" @endif>
                </div>
            @endforeach
        </div>
        <hr>
        <h2>User Information</h2>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Place Order</button>
    </form>
</div>
@endsection
