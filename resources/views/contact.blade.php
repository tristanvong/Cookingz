@extends('layouts.main')
@section('title', 'Contact Us')
@section('content')
<div class="container mx-auto mt-8 mb-8 px-4 md:w-1/2 lg:w-1/3">
    <h1 class="text-3xl font-semibold text-white mb-6">Contact Us</h1>
    <x-success-message />
    <x-error-message />
    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" required>
            @error('name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" required>
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea id="message" name="message" rows="4" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500" required></textarea>
            @error('message')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="w-full py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 focus:outline-none focus:ring-4 focus:ring-amber-300">
            Send Message
        </button>
    </form>
</div>
@endsection
