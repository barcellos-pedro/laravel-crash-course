<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        // Eager loading posts
        $posts = $user->posts()->with(['user', 'likes'])->paginate(3);

        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
