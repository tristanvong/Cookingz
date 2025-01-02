@extends('layouts.main')
@section('title', 'Contact Form Details')
@section('content')
<div class="container mx-auto mt-8 mb-8 px-4 md:w-4/5 lg:w-3/4">
        <h1 class="text-4xl font-bold text-white mb-6">Contact Form Details</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">
                    <strong>Name:</strong> {{ $contactForm->name }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">
                    <strong>Email:</strong> {{ $contactForm->email }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">
                    <strong>Message:</strong> {{ $contactForm->message }}
                </p>
            </div>
            <div class="mb-6">
                <p class="text-lg font-semibold text-gray-700">
                    <strong>Status:</strong> {{ ucfirst($contactForm->status) }}
                </p>
            </div>
            <div class="mb-4">
                <strong>Admin's Reply:</strong>
                <p>{{ $contactForm->reply }}</p>
            </div>

            <form action="{{ route('admin.contactForms.reply', $contactForm->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="reply" class="block text-sm font-medium text-gray-700">Reply:</label>
                    <textarea id="reply" name="reply" rows="4" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" required></textarea>
                </div>

                <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 focus:outline-none focus:ring-4 focus:ring-amber-300">
                    Send Reply
                </button>
            </form>
        </div>
    </div>
@endsection
