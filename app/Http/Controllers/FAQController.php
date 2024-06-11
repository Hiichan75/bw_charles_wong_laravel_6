<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\FAQCategory;

class FAQController extends Controller
{
    public function index()
    {
        $categories = FAQCategory::with('faqs')->get();
        return view('faq.index', compact('categories'));
    }

    public function create()
    {
        $categories = FAQCategory::all();
        return view('faq.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:f_a_q_categories,id',
        ]);

        $faq = new FAQ($request->only(['question', 'answer', 'category_id']));
        $faq->user_id = auth()->id();
        $faq->save();

        return redirect()->route('faq.index');
    }

    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        $categories = FAQCategory::all();
        return view('faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:f_a_q_categories,id',
        ]);

        $faq = FAQ::findOrFail($id);
        $faq->update($request->only(['question', 'answer', 'category_id']));

        return redirect()->route('faq.index');
    }

    public function destroy($id)
    {
        FAQ::destroy($id);
        return redirect()->route('faq.index');
    }
}
