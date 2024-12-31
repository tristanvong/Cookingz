@extends('layouts.main')
@section('title', 'Create FAQ')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-white mb-4">Create a New FAQ</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('faqs.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="question" class="block text-gray-700 font-bold mb-2">Question</label>
                <input type="text" name="question" id="question" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                       placeholder="Enter the question" required>
                @error('question')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="answer" class="block text-gray-700 font-bold mb-2">Answer</label>
                <textarea name="answer" id="answer" rows="5"
                          class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500"
                          placeholder="Enter the answer" required></textarea>
                @error('answer')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                <select name="category_id" id="category_id" 
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" 
                        class="py-2 px-4 bg-amber-500 text-white font-bold rounded-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-600">
                    Submit FAQ
                </button>
                <a href="{{ route('faqs.index') }}" 
                   class="py-2 px-4 ml-2 bg-gray-300 text-gray-800 font-bold rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection