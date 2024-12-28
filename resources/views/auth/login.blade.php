@extends('layouts.main')
@section('title', 'Login')
@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Login</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="emailOrUsername" class="block text-sm font-medium text-gray-700 mb-1">Email or Username</label>
                <input 
                    type="text" 
                    id="emailOrUsername" 
                    name="emailOrUsername" 
                    value="{{ old('emailOrUsername') }}" 
                    required
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 text-gray-900"
                >
                @error('emailOrUsername')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 text-gray-900"
                >
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember"
                    class="h-4 w-4 text-amber-600 focus:ring-amber-200 border-gray-300 rounded"
                >
                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember Me</label>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="w-full py-2 px-4 bg-amber-600 text-white rounded-lg shadow-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                >
                    Login
                </button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-amber-600 hover:text-amber-700">
                    Create one
                </a>
            </p>
        </div>
    </div>
</div>
@endsection