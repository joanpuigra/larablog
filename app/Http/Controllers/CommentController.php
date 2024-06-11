<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('posts.show', compact('post', 'comments'));
    }

   
    public function create(Post $post)
    {
        $comments = $post->comments;
        return view('posts.comments.create', compact('post', 'comments'));
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        if(auth()->check()) {
            Comment::create([
                'post_id' => $post->id,
                'content' => $request->content,
                'author_id' => auth()->id(),
                'date' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->route('posts.show', $post)->with('success', 'Comment created successfully');
        } else {
            return redirect()->route('posts.show', $post)->with('error', 'You must be logged in to comment');
        }
    }

    public function editComment(Post $post, Comment $comment)
    {
        $comment = Comment::find($comment->id);
        return view('comments.edit', compact('comment'));
    }

    public function updateComment(Request $request, Post $post, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = Comment::find($comment->id);
        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment updated successfully');
    }

    public function destroyComment(Post $post, Comment $comment)
    {
        $post = Post::find($post->id);
        $comment = Comment::find($comment->id);

        if(auth()->check()) {
            if($comment->author_id != auth()->id()) {
                return redirect()->route('posts.show', $post)->with('error', 'You can only delete your own comments');
            } else {
                $comment->delete();
                return redirect()->route('posts.show', $post)->with('success', 'Comment deleted successfully');
            }
        } else {
            return redirect()->route('posts.show', $post)->with('error', 'You must be logged in to delete a comment');
        }
    }
}

