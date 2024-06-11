<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQCategoryController extends Controller
{
    public function index()
    {
        $categories = FAQCategory::all();
        return view('admin.faq_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.faq_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        FAQCategory::create($request->all());

        return redirect()->route('admin.faq_categories.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = FAQCategory::findOrFail($id);
        return view('admin.faq_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = FAQCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.faq_categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        FAQCategory::destroy($id);
        return redirect()->route('admin.faq_categories.index')->with('success', 'Category deleted successfully!');
    }
}

