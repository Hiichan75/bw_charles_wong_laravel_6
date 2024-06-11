<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::with('category')->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        $categories = FAQCategory::all();
        return view('admin.faq.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:f_a_q_categories,id', // Update the validation rule
        ]);

        $faq = new FAQ($request->only(['question', 'answer', 'category_id']));
        $faq->user_id = auth()->id(); // Set the user_id to the authenticated user's ID
        $faq->save();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ created successfully!');
    }

    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        $categories = FAQCategory::all();
        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:f_a_q_categories,id', // Update the validation rule
        ]);

        $faq = FAQ::findOrFail($id);
        $faq->update($request->only(['question', 'answer', 'category_id']));

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully!');
    }

    public function destroy($id)
    {
        FAQ::destroy($id);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ deleted successfully!');
    }
}
