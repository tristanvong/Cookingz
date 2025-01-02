@extends('layouts.main')
@section('title', 'Edit Review')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Review</h1>

        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="rating" class="block text-gray-700">Rating:</label>
                <select name="rating" id="rating" class="w-full border rounded-lg px-4 py-2">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
                @error('rating')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="comment" class="block text-gray-700">Comment:</label>
                <textarea name="comment" id="comment" rows="4" class="w-full border rounded-lg px-4 py-2">{{ $review->comment }}</textarea>
                @error('comment')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection