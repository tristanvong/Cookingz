@extends('layouts.main')
@section('title', 'Create Category')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-white mb-4">Create New Category</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Category Name</label>
                <input type="text" id="name" name="name" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                       placeholder="Enter category name" required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500"
                          placeholder="Enter category description"></textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-gray-700 font-bold mb-2">Category Type</label>
                <select id="type" name="type"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" required>
                    <option value="recipe">Recipe</option>
                    <option value="faq">FAQ</option>
                </select>
                @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit"
                        class="py-2 px-4 bg-amber-500 text-white font-bold rounded-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-green-600">
                    Create Category
                </button>
                <a href="{{ route('categories.index') }}"
                   class="py-2 px-4 ml-2 bg-gray-300 text-gray-800 font-bold rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection