<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
    return view('product.index', compact('products'));
}

public function show($id)
{
    $product = Product::findOrFail($id);
    return view('product.show', compact('product'));
}

public function create()
{
    return view('product.create');
}

public function store(Request $request)
{
    $product = new Product($request->all());
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('product_images', 'public');
        $product->image = $path;
    }
    $product->save();
    return redirect()->route('product.index');
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('product.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('product_images', 'public');
        $product->image = $path;
    }
    $product->update($request->except('image'));
    return redirect()->route('product.index');
}

public function destroy($id)
{
    Product::destroy($id);
    return redirect()->route('product.index');
}

}
