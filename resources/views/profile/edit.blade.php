@extends('layouts.main')
@section('title', 'Edit Profile')
@section('content')
<div class="w-full mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-white mb-4">Profile of {{$user->name}}</h1>
    
    <div class="my-4 flex items-center">
        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <button type="submit" 
                    class="text-xl py-2 px-4 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Logout
            </button>
        </form>
        <a href="{{ route('profile.show', $user->id) }}" 
           class="text-xl py-2 px-4 bg-amber-500 text-white rounded-lg shadow-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 ml-4">
            View Profile
        </a>
        @if(Auth::user()->role === 'admin') 
        <div class="border-l-2 border-white h-8 mx-4"></div>
            <a href="/admin/dashboard" 
            class="border-white text-xl py-2 px-4 bg-amber-500 text-white rounded-lg shadow-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 ml-4">
                Go To Admin Panel
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="w-full">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
