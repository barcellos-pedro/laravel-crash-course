<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __construct()
    {
        // only authenticated users can access dashboard page
        $this->middleware(['auth']);
    }

    public function index()
    {
        // dd(auth()->user()); // ṕrint to check authenticated user
        // dd(auth()->user()->posts); // print Collection of Posts from User

        // Test email
        // $user = auth()->user();
        // Mail::to($user)->send(new PostLiked());

        return view('dashboard');
    }
}
