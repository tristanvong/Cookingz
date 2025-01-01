<div>
    @if ($noProfilePicture)
        <div class="{{ $customCss ?? 'w-32 h-32 bg-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center' }}">
            <span class="text-gray-500 text-lg">No Image</span>
        </div>
    @else
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
             class="{{ $customCss ?? 'w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-black' }}">
    @endif
</div>