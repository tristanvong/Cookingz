@extends('layouts.main')
@section('title', 'Profilepage')
@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
        <div class="bg-white shadow-md rounded-lg p-6 lg:w-4/5">
            <div class="text-center">
                @if ($user->profile_picture && file_exists(storage_path('app/public/' . $user->profile_picture)))
                    @include('components.profile-picture', ['user' => $user, 'noProfilePicture' => false])
                @else
                    @include('components.profile-picture', ['user' => $user, 'noProfilePicture' => true])
                @endif
                
                @if(!$user->privacy_mode)
                <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                @elseif(Auth::id() === $user->id)
                <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                <small>(Viewing own profile full name not shown for other user, privacy mode is enabled)</small><br>
                @endif
                <p class="text-gray-600 text-xl inline-flex">
                    <span>@</span>
                    <span>{{ $user->username }}</span>
                </p>
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">About Me</h2>
                <p class="text-gray-800">{{ $user->about_me ?? 'This user has not shared anything about themselves.' }}</p>
            </div>

            @if ($user->privacy_mode)
                 @if (Auth::id() === $user->id)
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-2">Personal Information <small>(viewing own profile, privacy mode is enabled (name, and personal information not shown for other users))</small></h2>
                        <ul class="text-gray-800">
                            <li><strong>Email:</strong> {{ $user->email }}</li>
                            <li><strong>Date of Birth:</strong> {{ $user->date_of_birth ? $user->date_of_birth->format('F j, Y') : 'N/A' }}</li>
                            <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                        </ul>
                    </div>
                @else
                <p class="mt-6 text-gray-600 text-lg">Privacy mode is enabled. Only the username and profile picture are shown.</p>
                @endif
            @else
                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Personal Information</h2>
                    <ul class="text-gray-800">
                        <li><strong>Email:</strong> {{ $user->email }}</li>
                        <li><strong>Date of Birth:</strong> {{ $user->date_of_birth ? $user->date_of_birth->format('F j, Y') : 'N/A' }}</li>
                        <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                    </ul>
                </div>
            @endif

            @if (Auth::check() && Auth::user()->id == $user->id)
                <div class="mt-4">
                    <a href="{{ route('profile.edit') }}" 
                    class="inline-block py-2 px-4 bg-amber-500 text-white rounded-lg shadow-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        Edit Profile
                    </a>
                </div>
            @endif

            <div class="container mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Public Messages</h2>

                @if ($publicMessages->isEmpty())
                    <p class="text-gray-600">No public messages to display.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($publicMessages as $message)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                 <a href="/p/{{$message->sender->id}}">
                                    <p class="text-lg font-semibold text-amber-500 hover:underline"><span>@</span>{{ $message->sender->username }}</p>
                                 </a>
                                <p class="text-gray-700">{{ $message->content }}</p>
                                <small class="text-gray-500">Sent at: {{ $message->created_at->format('Y-m-d H:i') }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('messages.storePublic', $user->id) }}" method="POST" class="mt-6" id="messageForm">
                    @csrf
                    <textarea name="content" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 " required placeholder="Write your public message..."></textarea>
                    <button type="submit" class="mt-3 px-6 py-2 bg-amber-500 text-white rounded-lg shadow-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Post Message</button>
                </form>

                <div class="mt-6">
                    <a href="{{ route('messages.private', $user->id) }}" 
                        class="inline-block px-6 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Send Private Message
                    </a>
                </div>
            </div>
        </div>
    </div>
    <button 
    id="scrollToggleButton" 
    class="fixed bottom-16 right-8 bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    Go to Bottom to Send Message
    </button>
</div>

<script>
    const scrollToggleButton = document.getElementById('scrollToggleButton');
    const messageForm = document.getElementById('messageForm');

    const scrollToBottom = () => {
        messageForm.scrollIntoView({ behavior: 'smooth' });
    };

    const scrollToTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const pageHeight = document.documentElement.scrollHeight - window.innerHeight;

        if (scrolled > pageHeight * 0.1) {
            scrollToggleButton.textContent = 'Go Back to Top';
            scrollToggleButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
            scrollToggleButton.classList.add('bg-amber-500', 'hover:bg-amber-600');
            scrollToggleButton.onclick = scrollToTop;
        } else {
            scrollToggleButton.textContent = 'Go to Bottom to Send Message';
            scrollToggleButton.classList.remove('bg-amber-500', 'hover:bg-amber-600');
            scrollToggleButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
            scrollToggleButton.onclick = scrollToBottom;
        }
    });

    scrollToggleButton.onclick = scrollToBottom;
</script>

@endsection