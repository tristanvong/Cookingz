<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Update Password</h1>

    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="update_password_current_password" class="block text-gray-700 font-bold mb-2">Current Password</label>
                <input type="password" name="current_password" id="update_password_current_password"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500"
                       autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="update_password_password" class="block text-gray-700 font-bold mb-2">New Password</label>
                <input type="password" name="password" id="update_password_password"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500"
                       autocomplete="new-password">
                @error('password', 'updatePassword')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="update_password_password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="update_password_password_confirmation"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-amber-500 focus:border-amber-500"
                       autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" 
                        class="py-2 px-4 bg-amber-500 text-white font-bold rounded-lg hover:bg-amber-600 focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                    Save
                </button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                       class="text-sm text-green-600">
                        Saved
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>
