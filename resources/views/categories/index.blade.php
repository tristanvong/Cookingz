@extends('layouts.main')
@section('title', 'Categories')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-white mb-4">Categories</h1>

    <a href="{{ route('categories.create') }}" class="inline-block mb-6 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Create Category</a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                <h2 class="text-lg font-bold text-gray-800">{{ $category->name }}</h2>
                <p class="text-sm text-gray-600">{{ $category->description }}</p>
                <p class="text-sm text-gray-600 mt-2">Type: {{ $category->type }}</p>
                
                <div class="mt-4 flex gap-4">
                    <a href="{{ route('categories.edit', $category->id) }}" class="inline-block py-2 px-4 bg-amber-500 text-white rounded-lg hover:bg-amber-600">Edit</a>

                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
