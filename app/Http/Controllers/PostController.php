<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
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
