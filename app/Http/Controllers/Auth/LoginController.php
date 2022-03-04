<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        // Only guests can access login page
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.login');
    }

    public function sign_in(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $is_authenticated = auth()->attempt(
            $request->only('email', 'password'),
            $request->remember
        );

        if (!$is_authenticated)
        {
            // Sends an flash error message, so we can display in login page through session('{key}')
            return back()->with('login_failed', 'Invalid username or password');
        }

        return redirect()->route('dashboard');
    }
}
