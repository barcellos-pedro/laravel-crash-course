<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Sign in (login)
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'sign_in']);

// Sign up
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'sign_up']);

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.delete');

// Single post page
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.post');

// Posts Like/Unlike
Route::post('/posts/{post}/like', [PostLikeController::class, 'store'])->name('posts.like');
Route::delete('/posts/{post}/unlike', [PostLikeController::class, 'destroy'])->name('posts.unlike');

// User's posts
Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');