@extends('layouts.main')
@section('title', 'Profilepage')
@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
        <div class="bg-white shadow-md rounded-lg p-6 lg:w-4/5">
            <div class="text-center">
                @if ($user->profile_picture && file_exists(storage_path('app/public/' . $user->profile_picture)))
                    @include('components.profile-picture', ['user' => $user])
                @else
                    <div class="w-32 h-32 bg-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-gray-500 text-lg">No Image</span>
                    </div>
                @endif

                
                <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                
                <p class="text-gray-600 text-xl inline-flex">
                    <span>@</span>
                    <span>{{ $user->username }}</span>
                </p>
                
                
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">About Me</h2>
                <p class="text-gray-800">{{ $user->about_me ?? 'This user has not shared anything about themselves.' }}</p>
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Personal Information</h2>
                <ul class="text-gray-800">
                    <li><strong>Email:</strong> {{ $user->email }}</li>
                    <li><strong>Date of Birth:</strong> {{ $user->date_of_birth ? $user->date_of_birth->format('F j, Y') : 'N/A' }}</li>
                    <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                </ul>
            </div>

            @if (Auth::check() && Auth::user()->id == $user->id)
                <div class="mt-4">
                    <a href="{{ route('profile.edit') }}" 
                    class="inline-block py-2 px-4 bg-amber-500 text-white rounded-lg shadow-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        Edit Profile
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection