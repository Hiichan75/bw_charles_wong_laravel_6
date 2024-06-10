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
        $faq = new FAQ($request->all());
        $faq->save();
        return redirect()->route('admin.faq.index');
    }

    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        $categories = FAQCategory::all();
        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->update($request->all());
        return redirect()->route('admin.faq.index');
    }

    public function destroy($id)
    {
        FAQ::destroy($id);
        return redirect()->route('admin.faq.index');
    }
}

