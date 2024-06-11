<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $products = Product::all();
        return view('order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'product_ids' => 'required|array',
            'quantities' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities.*' => 'integer|min:1',
        ]);

        $totalPrice = 0;
        $orderItems = [];

        foreach ($request->product_ids as $key => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$key];

            $orderItems[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
            ];

            $totalPrice += $product->price * $quantity;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'country' => $request->country,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($orderItems as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);
        }

        return redirect()->route('order.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('order.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('order.index', compact('orders'));
    }
}



