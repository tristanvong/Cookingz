<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Delete Account</h1>

    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <div class="space-y-6">
            <div id="delete-form" class="mt-6">
                <form action="{{ route('profile.destroy') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.                    </p>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-3/4 p-2 border border-gray-300 rounded-lg bg-white focus:ring-1 focus:ring-amber-500 focus:border-amber-500"
                            placeholder="Password"
                        />
                        @if ($errors->userDeletion->has('password'))
                            <div class="mt-2 text-sm text-red-600">
                                {{ $errors->userDeletion->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex ">
                        <button
                            type="submit"
                            class="py-2 px-4 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 focus:ring-1 focus:ring-red-500 focus:border-red-500"
                            onclick="return confirm('Are you sure you want to delete your account?')"
                        >
                        Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
