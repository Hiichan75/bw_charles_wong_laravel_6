<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('replies.user')->get();
        return view('admin.forum.index', compact('posts'));
    }

    public function edit($id)
    {
        $post = ForumPost::findOrFail($id);
        return view('admin.forum.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = ForumPost::findOrFail($id);
        $post->update($validated);

        return redirect()->route('admin.forum.index')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.forum.index')->with('success', 'Post deleted successfully!');
    }

    public function destroyReply($id)
    {
        $reply = ForumReply::findOrFail($id);
        $reply->delete();

        return redirect()->back()->with('success', 'Reply deleted successfully!');
    }
}
