<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Posts listing view
     */
    public function index()
    {
        // Get all posts as Collection
        // $posts = Post::get();

        // Pagination
        // $posts = Post::orderBy('created_at', 'desc')->paginate(2);

        // Eager loading
        // Bundle data from queries as one, before we iterate through them
        $posts = Post::with(['user', 'likes'])->latest()->paginate(3);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Single post page
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Create Post from the Post Model
        // Post::create([
        //     'user_id' => auth()->id,
        //     'body' => $request->body
        // ]);

        //or

        // Create Post from the signed user
        $request->user()->posts()->create([
            // $request->only('body')
            // or
            // user_id will automatically fill in
            'body' => $request->body
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete', $post);
        
        $post->delete();

        return back();
    }
}
