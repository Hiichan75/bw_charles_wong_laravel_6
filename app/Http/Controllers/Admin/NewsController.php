<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon for date manipulation

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
            // 'published_at' => 'required|date', // Remove this line since 'published_at' will be set automatically
        ]);

        $newsData = $request->only(['title', 'content']);
        $newsData['user_id'] = auth()->id();
        $newsData['published_at'] = Carbon::now(); // Set the current timestamp for 'published_at'

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('news_images', 'public');
            $newsData['cover_image'] = $path;
        }

        News::create($newsData);

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
            // 'published_at' => 'required|date', // Remove this line since 'published_at' will be handled automatically
        ]);

        $news = News::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('news_images', 'public');
            $news->cover_image = $path;
        }

        $newsData = $request->only(['title', 'content']);
        if (!$request->has('published_at')) {
            $newsData['published_at'] = Carbon::now(); // Set the current timestamp for 'published_at' if not provided
        }

        $news->update($newsData);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        News::destroy($id);
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}
