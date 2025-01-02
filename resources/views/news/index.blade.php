@extends('layouts.main')
@section('title', 'All News Items')
@section('content')
<div class="container mx-auto mt-8 mb-8">
    <h1 class="text-2xl font-bold text-white mb-4">All News Items</h1>

    <div class="mb-6 bg-white p-4 rounded-lg flex items-center justify-between w-fit">
        <form method="GET" action="{{ route('news.index') }}" class="flex items-center gap-4">
            <label for="sort" class="text-gray-800">Sort by:</label>
            <select name="sort" id="sort" onchange="submit()" class="focus:bg-white rounded focus:ring-1 focus:ring-amber-600 focus:outline-none focus:border-amber-600">
                <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Newest First</option>
                <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>Oldest First</option>
            </select>
        </form>
        @if (Auth::user() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.news.create') }}" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition ml-4">
                Create New News Item
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($newsItems as $newsItem)
            <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                @if ($newsItem->image && in_array(pathinfo($newsItem->image, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp']))
                    <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-48 h-48 object-cover mx-auto rounded-lg">
                @endif
                <div class="mt-4 flex-grow">
                    <h2 class="text-lg font-bold text-gray-800">{{ $newsItem->title }}</h2>
                    <p class="text-sm text-gray-600">{{ Str::limit($newsItem->content, 100) }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        <span class="font-bold">Published On:</span> {{ $newsItem->published_at->format('F j, Y') }}
                    </p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('news.show', $newsItem->id) }}" class="inline-block py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Read More</a>
                </div>
            </div>
        @empty
            <p class="text-white">No news items found.</p>
        @endforelse
    </div>
</div>
@endsection
