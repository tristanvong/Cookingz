<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Profile Information</h1>

    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            @if (session('status') === 'profile-updated')
                <div class="my-2 w-max bg-green-500 text-white p-4 rounded-lg shadow-md opacity-90">
                    <p class="text-md font-medium">Successfully Saved Data</p>
                </div>
            @endif


            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                <input type="text" name="username" id="username" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                       value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                       value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.
                        <button form="send-verification" 
                                class="underline text-sm text-indigo-600 hover:text-indigo-800 focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                                Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                @endif
            </div>

            <div class="mb-4">
                <label for="date_of_birth" class="block text-gray-700 font-bold mb-2">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500" 
                       value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                @error('date_of_birth')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="about_me" class="block text-gray-700 font-bold mb-2">About Me</label>
                <textarea name="about_me" id="about_me" rows="4"
                          class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500">{{ old('about_me', $user->about_me) }}</textarea>
                @error('about_me')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="profile_picture" class="block text-gray-700 font-bold mb-2">Profile Picture</label>

                @if ($user->profile_picture && file_exists(storage_path('app/public/' . $user->profile_picture)))
                    <div class="mb-4">
                        @include('components.profile-picture', ['user' => $user])
                    </div>
                @else
                    <div class="bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500 p-4 rounded-lg shadow-md max-w-max my-4">
                        <div class="flex items-center">
                            <p class="text-sm font-medium">
                                You do not have a profile picture yet.
                            </p>
                        </div>
                    </div>
                @endif

                <input type="file" name="profile_picture" id="profile_picture" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                @error('profile_picture')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" 
                        class="py-2 px-4 bg-amber-500 text-white font-bold rounded-lg hover:bg-amber-600 focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>