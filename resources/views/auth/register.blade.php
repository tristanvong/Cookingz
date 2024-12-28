@extends('layouts.main')
@section('title', 'Register')
@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Create an Account</h1>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 text-gray-900"
                >
                @error('name')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="username" 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 text-gray-900"
                >
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 text-gray-900"
                >
                @error('username')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>


            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    autocomplete="new-password" 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 text-gray-900"
                >
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 text-gray-900"
                >
                @error('password_confirmation')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button 
                    type="submit" 
                    class="w-full py-2 px-4 bg-amber-600 text-white rounded-lg shadow-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                >
                    Register
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-amber-600 hover:text-amber-700">
                    Login
                </a>
            </p>
        </div>
    </div>
</div>

@endsection
