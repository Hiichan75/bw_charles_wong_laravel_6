@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('order.store', $product->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_name">Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="customer_email">Email</label>
            <input type="email" name="customer_email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
