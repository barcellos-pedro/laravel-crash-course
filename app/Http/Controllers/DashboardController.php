<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('dashboard');
    }
}
