<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\ForumReply;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('replies.user')->get(); // Load replies with user details
        return view('forum.index', compact('posts'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new ForumPost($request->only('title', 'content'));
        $post->user_id = auth()->id(); // or Auth::id() if you have 'use Auth' at the top
        $post->save();

        return redirect()->route('forum.index')->with('success', 'Post created successfully!');
    }

    public function show($id)
    {
        $post = ForumPost::with('replies')->findOrFail($id);
        return view('forum.show', compact('post'));
    }

    public function storeReply(Request $request, $postId)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        ForumReply::create([
            'content' => $validated['reply'],
            'forum_post_id' => $postId,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.index')->with('success', 'Reply added successfully!');
    }
}
