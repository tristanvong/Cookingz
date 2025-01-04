@extends('layouts.main')
@section('title', 'Private Messages')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-semibold text-white mb-6">
        Private Messages with
        <a href="{{ route('profile.show', $user->id) }}" class="text-amber-500 hover:underline">
            <span>@</span>{{ $user->username }}
        </a>
    </h2>
    <div class="space-y-4 mb-6">
        @foreach ($messages as $message)
            @if ($message->type === 'private')
                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg shadow-md">
                        @include('components.profile-picture', [
                            'user' => $message->sender,
                            'noProfilePicture' => !$message->sender->profile_picture,
                            'customCss' => 'w-12 h-12 object-cover rounded-full border-2 border-black'
                        ])

                    <div class="flex-1">
                        <p class="font-semibold text-gray-700"><span>@</span>{{ $message->sender->username }}</p>
                        <p class="text-gray-800">{{ $message->content }}</p>
                        <small class="text-gray-500 text-xs">Sent at: {{ $message->created_at->format('Y-m-d H:i') }}</small>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 sticky bottom-0 left-0 w-full mb-4 z-10">
        <form action="{{ route('messages.storePrivate', $user->id) }}" method="POST">
            @csrf
            <textarea name="content" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500" required placeholder="Write your message..."></textarea>
            <button type="submit" class="mt-4 px-6 py-2 bg-amber-500 text-white rounded-lg shadow-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">Send Message</button>
        </form>
    </div>
</div>
@endsection