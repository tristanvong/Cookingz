@extends('layouts.main')
@section('title', $newsItem->title)
@section('content')
<div class="container mx-auto mt-8 mb-8 lg:w-1/2">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $newsItem->title }}</h1>
        
        @if ($newsItem->image)
            <div class="mb-4 w-full">
                <img src="{{ asset('storage/' . $newsItem->image) }}" 
                     alt="Image for {{ $newsItem->title }}" 
                     class="w-96 h-80 object-contain rounded-lg">
            </div>
        @endif

        <p class="text-sm text-gray-500 mb-4">
            <span class="font-semibold">Published on:</span> {{ $newsItem->published_at->format('F j, Y') }}
        </p>

        <div class="text-gray-700 text-lg leading-relaxed mb-6">
            {{ $newsItem->content }}
        </div>

        @if(auth()->user() && auth()->user()->role === 'admin')
            <div class="flex space-x-4">
                <a href="{{ route('admin.news.edit', $newsItem->id) }}" 
                   class="py-2 px-4 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition">
                    Edit
                </a>
                
                <form method="POST" action="{{ route('admin.news.destroy', $newsItem->id) }}" onsubmit="return confirm('Are you sure you want to delete this news item?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Delete
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
