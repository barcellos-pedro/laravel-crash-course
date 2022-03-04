<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        // Only guests can access register page
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function sign_up(Request $request)
    {
        // like var_dump but, we prevent the default flow of the page and print info
        // dd($request->email, $request->username, $request->password, $request->password_confirmation);

        // Validate
        $this->validate($request, [ // if it fails, throws exception wich redirects user back with the errors
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        // Store in database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Sign in
        auth()->attempt(
            $request->only('email', 'password') // return an assoc array only with the specified fields from request
        );

        // Redirect
        return redirect()->route('dashboard');
    }
}
