@extends('layouts.main')
@section('title', 'Recipe')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        @if($recipe->image && in_array(pathinfo($recipe->image, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp']))
            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="mx-auto mb-4 rounded-lg max-w-full max-h-96 object-cover">
        @endif
        <div class="p-6">
            <div class="flex justify-between items-start">
                <h1 class="text-4xl font-bold text-gray-800">{{ $recipe->title }}</h1>
                @if(Auth::check() && Auth::id() === $recipe->user_id)
                    <div class="flex space-x-4">
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                            <!-- Font awesome (free to use) -->
                            <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center">
                                <!-- Font awesome (free to use) -->
                                <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            <p class="text-gray-600 text-lg mt-4">{{ $recipe->description }}</p>
            <div class="flex items-center space-x-4 mt-4">
                <p class="text-gray-600 text-lg">Rating (average):</p>
                @if($recipe->reviews->count() > 0)
                    @include('components.star-rating', ['rating' => $recipe->avgRating()])
                @else
                    <p class="text-gray-600">No ratings yet.</p>
                @endif
            </div>
            <div class="mt-6 grid grid-cols-2 gap-4 text-gray-700">
                <p><strong>By:</strong> {{ $recipe->user->name }}</p>
                <p><strong>Country:</strong> {{ $recipe->country }}</p>
                <p><strong>Preparation Time:</strong> {{ $recipe->preparation_time }} minutes</p>
                <p><strong>Category:</strong> {{ $recipe->category->name ?? 'Uncategorized' }}</p>
                <p><strong>Instructions:</strong> {{ $recipe->instructions }} </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Ingredients</h2>
        <ul class="list-disc pl-6 text-gray-700">
            @if($recipe->ingredients)
                @foreach(json_decode($recipe->ingredients) as $ingredient)
                    <li>{{ $ingredient }}</li>
                @endforeach
            @else
                <li>No ingredients available.</li>
            @endif
        </ul>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Reviews</h2>
        @if($recipe->reviews->count() > 0)
            <div class="space-y-6">
                @foreach($recipe->reviews as $review)
                    <div class="border-b border-gray-300 pb-4">
                        <p class="text-gray-800 font-semibold">
                            {{ $review->user->name }} 
                            @include('components.star-rating', ['rating' => $review->rating])
                        </p>
                        <p class="text-gray-600 mt-2">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No reviews yet. Be the first to review!</p>
        @endif
    </div>
</div>
@endsection
