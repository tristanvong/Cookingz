@extends('layouts.main')
@section('title', 'Recipe')
@section('content')
<div class="container mx-auto px-4 py-8">
    <x-success-message />
    <x-error-message />
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
                            Edit
                        </a>
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center">
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

        @auth
            @if (!$recipe->reviews->where('user_id', Auth::id())->count() > 0)            
            <form action="{{ route('reviews.store', $recipe->id) }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700">Your Rating:</label>
                    <select name="rating" id="rating" class="w-full border rounded-lg px-4 py-2">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                    @error('rating')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700">Your Comment:</label>
                    <textarea name="comment" id="comment" rows="4" class="w-full border rounded-lg px-4 py-2"></textarea>
                    @error('comment')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg">
                    Submit Review
                </button>
            </form>
            @else
                <div class="bg-yellow-100 border-4 border-yellow-500 text-yellow-700 p-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-8 w-8 mr-2" fill="currentColor">
                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336l24 0 0-64-24 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 88 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                    </svg>
                
                    <p class="text-gray-500">You have already submitted a review for this recipe. Please edit your review or delete it to post a new one. Thank you.</p>
                </div>
            @endif

        @endauth

        @guest
            <p class="text-gray-500">You need to <a href="{{ route('login') }}" class="text-amber-500 hover:underline">log in</a> to submit a review.</p>
        @endguest

        @if($recipe->reviews->count() > 0)

        @if(Auth::check())
            @php
                $userReview = $recipe->reviews->where('user_id', Auth::id())->first();  
                $otherReviews = $recipe->reviews->where('user_id', '!=', Auth::id()); 
            @endphp
        @endif

        <div class="space-y-6">
            @if($userReview)
                <div class="border-b border-gray-300 pb-4">
                    <p class="text-gray-800 font-semibold">
                        {{ $userReview->user->name }} 
                        @include('components.star-rating', ['rating' => $userReview->rating])
                        @if($userReview->created_at != $userReview->updated_at)
                            <span class="text-sm text-gray-500">(edited)</span>
                        @endif
                    </p>
                    <p class="text-gray-600 mt-2">{{ $userReview->comment }}</p>

                    <div class="flex space-x-4 mt-2">
                        <a href="{{ route('reviews.edit', [$recipe->id, $userReview->id]) }}" class="text-amber-500 hover:underline">Edit</a>
                        <form action="{{ route('reviews.destroy', [$recipe->id, $userReview->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @endif

            @foreach($otherReviews as $review)
                <div class="border-b border-gray-300 pb-4">
                    <p class="text-gray-800 font-semibold">
                        {{ $review->user->name }} 
                        @include('components.star-rating', ['rating' => $review->rating])
                        @if($review->created_at != $review->updated_at)
                            <span class="text-sm text-gray-500">(edited)</span>
                        @endif
                    </p>
                    <p class="text-gray-600 mt-2">{{ $review->comment }}</p>

                    @if(Auth::check() && Auth::id() === $review->user_id)
                        <div class="flex space-x-4 mt-2">
                            <a href="{{ route('reviews.edit', [$recipe->id, $review->id]) }}" class="text-amber-500 hover:underline">Edit</a>
                            <form action="{{ route('reviews.destroy', [$recipe->id, $review->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
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
            <p class="text-gray-500">No reviews yet. Be the first to review!</p>
        @endif
    </div>
</div>
@endsection
