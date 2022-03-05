<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::get(); // get all posts as Collection
        $posts = Post::orderBy('created_at', 'desc')->paginate(2); // Pagination as Collection

        return view('posts.index', ['posts' => $posts]);
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
}
