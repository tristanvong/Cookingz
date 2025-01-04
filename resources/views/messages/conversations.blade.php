@extends('layouts.main')
@section('title', 'Conversations')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-semibold text-white mb-6">Your Conversations</h2>

    @if ($conversations->isEmpty())
        <p class="text-gray-500">You have no private conversations yet.</p>
    @else
        <div class="space-y-4">
            @foreach ($conversations as $user)
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        @include('components.profile-picture', [
                            'user' => $user,
                            'noProfilePicture' => !$user->profile_picture,
                            'customCss' => 'w-12 h-12 object-cover rounded-full border-2 border-black'
                        ])
                        <div>
                            <p class="font-semibold text-gray-700"><span>@</span>{{ $user->username }}</p>
                            <p class="text-gray-800">Last message sent at: {{ $user->messages()->latest()->first()->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('messages.private', $user->id) }}" 
                    class="px-6 py-2 bg-amber-500 text-white rounded-lg shadow-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        View Conversation
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
