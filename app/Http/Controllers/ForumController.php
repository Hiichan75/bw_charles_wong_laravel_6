<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\ForumReply;

class ForumController extends Controller
{
    public function index()
{
    $posts = ForumPost::with('replies')->get();
    return view('forum.index', compact('posts'));
}

public function create()
{
    return view('forum.create');
}

public function store(Request $request)
{
    $post = new ForumPost($request->all());
    $post->user_id = auth()->id();
    $post->save();
    return redirect()->route('forum.index');
}

public function show($id)
{
    $post = ForumPost::with('replies')->findOrFail($id);
    return view('forum.show', compact('post'));
}

public function storeReply(Request $request, $postId)
{
    $reply = new ForumReply($request->all());
    $reply->post_id = $postId;
    $reply->user_id = auth()->id();
    $reply->save();
    return redirect()->route('forum.show', $postId);
}

}
