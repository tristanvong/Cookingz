@extends('layouts.main')
@section('title', 'Edit Profile')
@section('content')
<div class="w-full mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-white mb-4">Profile of {{$user->name}}</h1>
    
    <div class="my-4">
        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <button type="submit" 
                    class="text-xl py-2 px-4 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Logout
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full flex-grow">
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
