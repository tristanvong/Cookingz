@extends('layouts.main')
@section('title', $category->name . ' FAQs')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-white">{{ $category->name }}</h1>
    <p class="text-sm text-white mb-4">{{ $category->description }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($category->faqItems as $faq)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-gray-800">{{ $faq->question }}</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $faq->answer }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection