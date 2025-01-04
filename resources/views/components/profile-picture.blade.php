<div>
    @if ($noProfilePicture)
        <img src="{{ asset('storage/profile_pictures/placeholder.png') }}" alt="Profile Picture"
        class="{{ $customCss ?? 'w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-black' }}">
    @else
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
             class="{{ $customCss ?? 'w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-black' }}">
    @endif
</div>