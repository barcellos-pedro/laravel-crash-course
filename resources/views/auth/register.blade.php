@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="name" class="sr-only">Name</label>
                <input type="text" id="name" name="name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" placeholder="Your name" value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="username" class="sr-only">Username</label>
                <input type="text" id="username" name="username" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" placeholder="Your username" value="{{ old('username') }}">
                @error('username')
                <p class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="sr-only">E-mail</label>
                <input type="email" id="email" name="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" placeholder="Your e-mail" value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" placeholder="Choose a password">
                @error('password')
                <p class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="sr-only">Password again</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-100 border-2 w-full p-4 rounded-lg" placeholder="Repeat your password">
            </div>
            <button type="submit" class="bg-blue-500 text-white py-3 rounded font-medium w-full">
                Register
            </button>
        </form>
    </div>
</div>
@endsection