@extends('layouts.main')
@section('title', 'Propose a new FAQ')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Propose an FAQ</h1>

    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <form method="POST" action="{{ route('faq-proposals.store') }}">
            @csrf

            <div class="mb-4">
                <label for="question" class="block text-gray-700 font-bold mb-2">Question</label>
                <input type="text" name="question" id="question" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                       value="{{ old('question') }}" required>
                @error('question')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="answer" class="block text-gray-700 font-bold mb-2">Answer</label>
                <textarea name="answer" id="answer" rows="4" 
                          class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                          required>{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

            <div class="mt-6">
                <button type="submit" 
                        class="py-2 px-4 bg-amber-500 text-white font-bold rounded-lg hover:bg-amber-600 focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                    Submit Proposal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection