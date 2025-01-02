@extends('layouts.main')
@section('title', 'Reply to Contact Form')
@section('content')
<div class="container mx-auto mt-8 px-4 md:w-4/5 lg:w-3/4">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Reply to Contact Form</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.contactForms.reply', $contactForm->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ $contactForm->name }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" readonly>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ $contactForm->email }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" readonly>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" name="message" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" readonly>{{ $contactForm->message }}</textarea>
            </div>

            <div class="mb-4">
                <label for="reply" class="block text-sm font-medium text-gray-700">Your Reply</label>
                <textarea id="reply" name="reply" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Send Reply</button>
        </form>
    </div>
</div>
@endsection
