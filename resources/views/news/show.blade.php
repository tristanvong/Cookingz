@extends('layouts.main')
@section('title', $newsItem->title)
@section('content')
<div class="container mx-auto px-4 py-8 lg:w-1/2">
    <x-success-message />
    <x-error-message />
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="p-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $newsItem->title }}</h1>
            
            @if ($newsItem->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $newsItem->image) }}" 
                         alt="Image for {{ $newsItem->title }}" 
                         class="mx-auto mb-4 rounded-lg max-w-full max-h-96 object-cover">
                </div>
            @endif

            <p class="text-sm text-gray-500 mb-4">
                <span class="font-semibold">Published on:</span> {{ $newsItem->published_at->format('F j, Y') }}
            </p>

            <div class="text-gray-700 text-lg leading-relaxed mb-6">
                {{ $newsItem->content }}
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Comments</h2>
        @auth
            <form method="POST" action="{{ route('comments.store', $newsItem->id) }}" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-gray-700">Leave a comment:</label>
                    <textarea name="content" id="content" rows="4" class="w-full border rounded-lg px-4 py-2" placeholder="Write your comment here..."></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg">
                    Submit Comment
                </button>
            </form>
        @endauth

        @guest
            <p class="text-gray-500">You need to <a href="{{ route('login') }}" class="text-amber-500 hover:underline">log in</a> to submit a comment.</p>
        @endguest

        @if($newsItem->comments->count() > 0)
            <div class="space-y-6">
                @foreach ($newsItem->comments as $comment)
                    <div class="border-b border-gray-300 pb-4">
                        <p class="text-gray-800 font-semibold">
                            {{ $comment->user->name }}
                            @if($comment->created_at != $comment->updated_at)
                                <span class="text-sm text-gray-500">(edited)</span>
                            @endif
                        </p>
                        <p class="text-gray-600 mt-2">{{ $comment->content }}</p>

                        <p class="text-sm text-gray-500 mt-2">
                            commented at {{ $comment->created_at->format('F j, Y \a\t g:i A') }}
                        </p>

                        @if ($comment->user_id === auth()->id())
                            <div class="flex space-x-4 mt-2">
                                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
        @endif
    </div>
</div>
@endsection
