<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productData = $request->only(['name', 'description', 'price']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $productData['image'] = $path;
        }

        $product = new Product($productData);
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $productData = $request->only(['name', 'description', 'price']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $productData['image'] = $path;
        }

        $product->update($productData);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
    }
}
