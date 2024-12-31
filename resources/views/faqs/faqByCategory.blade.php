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
                <p class="text-sm text-gray-600 mt-2 break-words">{{ $faq->answer }}</p>
                @if (optional(Auth::user())->role === 'admin')
                    <a href="{{ route('faqs.edit', $faq->id) }}" class="inline-block mt-4 px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600">Edit FAQ</a>
                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" class="inline-block mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                            onclick="return confirm('Are you sure you want to delete this FAQ?')">Delete FAQ</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection