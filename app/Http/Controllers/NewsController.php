<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
{
    $news = News::all();
    return view('news.index', compact('news'));
}

public function create()
{
    return view('news.create');
}

public function store(Request $request)
{
    $news = new News($request->all());
    $news->user_id = auth()->id();
    if ($request->hasFile('cover_image')) {
        $path = $request->file('cover_image')->store('news_images', 'public');
        $news->cover_image = $path;
    }
    $news->save();
    return redirect()->route('news.index');
}

public function edit($id)
{
    $news = News::findOrFail($id);
    return view('news.edit', compact('news'));
}

public function update(Request $request, $id)
{
    $news = News::findOrFail($id);
    if ($request->hasFile('cover_image')) {
        $path = $request->file('cover_image')->store('news_images', 'public');
        $news->cover_image = $path;
    }
    $news->update($request->except('cover_image'));
    return redirect()->route('news.index');
}

public function destroy($id)
{
    News::destroy($id);
    return redirect()->route('news.index');
}

}
