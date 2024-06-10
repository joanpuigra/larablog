<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    // Show posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Show by id
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post]);
    }

    // Create new post
    public function create()
    {
        return view('posts.create');
    }

    // Store new post
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

    // Edit post
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    // Update post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        if(auth()->check()) {
            $post = Post::find($id);
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
            return redirect()->route('posts.index')->with('success', 'Post updated successfully');
        } else {
            return redirect()->route('posts.index')->with('error', 'You must be logged in to update a post');
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        
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
