<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'required|date',
        ]);

        $news = new News($request->all());
        $news->user_id = auth()->id();

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('news_images', 'public');
            $news->cover_image = $path;
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News created successfully!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'required|date',
        ]);

        $news = News::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('news_images', 'public');
            $news->cover_image = $path;
        }

        $news->update($request->except('cover_image'));

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        News::destroy($id);
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}

