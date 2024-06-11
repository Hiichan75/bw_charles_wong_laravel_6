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
                    <input class="form-check-input" type="radio" name="product_id" value="{{ $productItem->id }}" id="product{{ $productItem->id }}" onchange="updateQuantityInput(this.value)">
                    <label class="form-check-label" for="product{{ $productItem->id }}">
                        {{ $productItem->name }} ({{ $productItem->formatted_price }})
                    </label>
                </div>
            @endforeach
            <div class="mt-2" id="quantityContainer" style="display: none;">
                <label for="quantity">Quantity</label>
                <input class="form-control" type="number" id="quantity" name="quantity" min="1" placeholder="Quantity">
            </div>
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

<script>
    function updateQuantityInput(productId) {
        const quantityContainer = document.getElementById('quantityContainer');
        quantityContainer.style.display = 'block';
        quantityContainer.querySelector('input').value = 1;
    }
</script>
@endsection
