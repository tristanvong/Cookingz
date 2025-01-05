@extends('layouts.main')
@section('title', 'FAQs')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-white mb-4">FAQ Categories</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                <h2 class="text-lg font-bold text-gray-800">{{ $category->name }}</h2>
                <p class="text-sm text-gray-600">{{ $category->description }}</p>
                <div class="mt-4">
                    <a href="{{ route('faqs.category', $category->id) }}" class="inline-block py-2 px-4 bg-amber-500 text-white rounded-lg hover:bg-amber-600">View FAQs</a>
                </div>
            </div>
        @endforeach
    </div>
    @auth
        <div class="mt-6">
            <a href="/faq-proposals" class="inline-block py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Go to FAQ Proposals</a>
        </div>
    @endauth
</div>
@endsection
