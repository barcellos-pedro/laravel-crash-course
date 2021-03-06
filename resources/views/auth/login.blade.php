@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg">
        @if (session('login_failed'))
        <p class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
            {{ session('login_failed')}}
        </p>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="email" class="sr-only">E-mail</label>
                <input type="email" id="email" name="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" placeholder="Your e-mail" value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" placeholder="Your password">
                @error('password')
                <p class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="remember" class="cursor-pointer">
                    <input type="checkbox" name="remember" id="remember" class="mr-1">
                    Remember me
                </label>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-3 rounded font-medium w-full">
                Login
            </button>
        </form>
    </div>
</div>
@endsection