@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <!-- Create Post -->
        @auth
        <form action="{{ route('posts') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something great!"></textarea>
                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
        </form>
        @endauth
        <!-- Posts Listing -->
        @if($posts->count())
            @foreach ($posts as $post)
                <!-- Blade anonymous component with props -->
                <x-post :post="$post"/>
            @endforeach
            <!-- Pagination -->
            {{ $posts->links() }}
        @else
            <p class="mt-2">There ae no posts</p>
        @endif
    </div>
</div>
@endsection