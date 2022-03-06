<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        $likedByUser = $post->likedBy($request->user());

        // Limit one like per user
        if(! $likedByUser)
        {
            // Like the post
            $post->likes()->create([
                'user_id' => $request->user()->id,
            ]);

            // Send e-mail notification to the person who got the like
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        // Unlike an post from the user's liked posts
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
