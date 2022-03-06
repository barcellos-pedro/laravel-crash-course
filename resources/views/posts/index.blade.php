@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <!-- Create Post -->
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
        <!-- Posts Listing -->
        @if($posts->count())
        @foreach ($posts as $post)
        <div class="mt-2 mb-4">
            <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
            <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
            <p class="my-2">{{ $post->body }}</p>
            <p class="inline mr-2">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes) }}</p>
            @auth
            @if (!$post->likedBy(auth()->user()))
            <form action="{{ route('posts.like', $post) }}" method="post" class="mr-2 inline">
                @csrf
                <button type="submit" class="text-blue-500">👍🏻 Like</button>
            </form>
            @else
            <form action="{{ route('posts.unlike', $post) }}" method="post" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">👎🏻 Unlike</button>
            </form>
            @endif
            @can('delete', $post)
            <form action="{{ route('posts.delete', $post) }}" method="post" class="inline ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white text-sm rounded p-2 font-medium">Delete</button>
            </form>
            @endcan
            @endauth
        </div>
        @endforeach
        <!-- Pagination -->
        {{ $posts->links() }}
        @else
        <p class="mt-2">There ae no posts</p>
        @endif
    </div>
</div>
@endsection