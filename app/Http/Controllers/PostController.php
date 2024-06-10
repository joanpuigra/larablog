<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        if(auth()->check()) {
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'author_id' => auth()->id(),
                'date' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->route('posts.index')->with('success', 'Post created successfully');
        } else {
            return redirect()->route('posts.index')->with('error', 'You must be logged in to create a post');
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        $post = Post::findOrfail($post->id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::findOrfail($post->id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index'->with('success', 'Post updated successfully'));
    }

    public function destroy(Post $post)
    {
        $post = Post::findOrfail($post->id);
        
        if(auth()->check()) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        } else {
            if($post->author_id != auth()->id()) {
                return redirect()->route('posts.index')->with('error', 'You can only delete your own posts');
            } else {
                return redirect()->route('posts.index')->with('error', 'You must be logged in to delete a post');
            }
        }
    }

    public function destroyComment(Post $post, Comment $comment)
    {
        $post = Post::findOrfail($post->id);
        $comment = Comment::findOrfail($comment->id);
        if ($comment->author_id != auth()->id()) {
            return redirect()->route('posts.show', $post)->with('error', 'You can only delete your own comments');
        } else {
            $comment->delete();
            return redirect()->route('posts.show', $post)->with('success', 'Comment deleted successfully');
        }
    }
}
