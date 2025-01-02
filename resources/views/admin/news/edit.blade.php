@extends('layouts.main')

@section('title', 'Edit News Item')

@section('content')
    <div class="container mx-auto mt-8 mb-8 px-4 lg:w-1/2">
        <h1 class="text-3xl font-semibold text-white mb-6">Edit News Item</h1>

        <form method="POST" action="{{ route('admin.news.update', $newsItem->id) }}" enctype="multipart/form-data" class="space-y-4 bg-white p-4 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" value="{{ old('title', $newsItem->title) }}" required>
                @error('title')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="4" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500" required>{{ old('content', $newsItem->content) }}</textarea>
                @error('content')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center space-x-4 ">
                <div class="w-1/3">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image (optional)</label>
                    <input type="file" name="image" id="image" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                    @error('image')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                
                @if ($newsItem->image)
                    <div class="flex-shrink-0">
                        <label class="block text-sm font-medium text-gray-700">Current Image</label>
                        <img src="{{ asset('storage/' . $newsItem->image) }}" alt="Existing Image" class="h-32 rounded-lg border border-gray-300">
                    </div>
                @endif
            </div>

            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700">Publication Date</label>
                <input type="date" name="published_at" id="published_at" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500" value="{{ old('published_at', $newsItem->published_at->format('Y-m-d')) }}" required>
                @error('published_at')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 focus:outline-none focus:ring-4 focus:ring-amber-300">
                Update News Item
            </button>
        </form>
    </div>
@endsection
