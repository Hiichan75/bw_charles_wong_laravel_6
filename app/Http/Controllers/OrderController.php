<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function create($productId)
{
    $product = Product::findOrFail($productId);
    return view('order.create', compact('product'));
}

public function store(Request $request, $productId)
{
    $product = Product::findOrFail($productId);
    $order = new Order($request->all());
    $order->product_id = $productId;
    $order->total = $product->price * $request->quantity;
    $order->save();
    return redirect()->route('product.index')->with('success', 'Order placed successfully!');
}

}
