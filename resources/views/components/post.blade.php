@props(['post' => $post])

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