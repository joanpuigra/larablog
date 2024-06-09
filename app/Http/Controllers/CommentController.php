<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function show(Comment $comment)
    {
        return redirect()->route('comments.show', ['comment' => $comment->id]);
    }

    public function edit(Comment $comment)
    {
        $comment = Comment::findOrfail($comment->id);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = Comment::findOrfail($comment->id);
        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('comments.index'->with('success', 'Comment updated successfully'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required',
        ]);

        if(auth()->check()) {
            Comment::create([
                'post_id' => $request->id,
                'content' => $request->content,
                'author_id' => auth()->id(),
                'date' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->route('comments.index')->with('success', 'Comment created successfully');
        } else {
            return redirect()->route('comments.index')->with('error', 'You must be logged in to comment');
        }
    }
}
