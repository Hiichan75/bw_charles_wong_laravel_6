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
        $product = new Product($request->all());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $product->image = $path;
        }
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $product->image = $path;
        }
        $product->update($request->except('image'));
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.product.index');
    }
}
