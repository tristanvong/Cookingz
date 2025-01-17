@extends('layouts.admin')
@section('title', 'Manage Users')
@section('content')
<div class="container mx-auto mt-8 mb-8">
    <h1 class="text-3xl font-semibold text-white mb-6">Manage Users</h1>

    <x-success-message />

    <div class="mb-6 bg-white p-4 rounded-lg flex items-center justify-between w-full">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search by Username or Email"
                class="px-4 py-2 rounded focus:ring-1 w-96 focus:ring-amber-600 focus:outline-none focus:border-amber-600"
            >
            <select name="sort" id="sort" onchange="submit()" class="focus:bg-white rounded focus:ring-1 focus:ring-amber-600 focus:outline-none focus:border-amber-600">
                <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>ID Ascending</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>ID Descending</option>
            </select>
        </form>

        @if (Auth::user() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.create') }}" class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ml-4">
                Create New User
            </a>
        @endif
    </div>

    <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-2 text-left text-gray-800">ID</th>
                    <th class="px-6 py-2 text-left text-gray-800">Name</th>
                    <th class="px-6 py-2 text-left text-gray-800">Email</th>
                    <th class="px-6 py-2 text-left text-gray-800">Username</th>
                    <th class="px-6 py-2 text-left text-gray-800">Role</th>
                    <th class="px-6 py-2 text-center text-gray-800">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $user->id }}</td> 
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->username }}</td>
                        <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-between gap-4">
                                <div class="flex gap-4">
                                    @if ($user->role !== 'admin')
                                        <form action="{{ route('admin.users.makeAdmin', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-32 px-3 py-1 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                                                Make Admin
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.revokeAdmin', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-32 px-3 py-1 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                                                Revoke Admin
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <form action="{{ route('profile.show', $user->id) }}" method="GET" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        Go to Profile
                                    </button>
                                </form>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>

                                @if($user->is_blacklisted)
                                    <form action="{{ route('blacklists.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to revoke this user\'s blacklist?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Unblacklist</button>
                                    </form>
                                @else
                                    <form action="{{ route('blacklists.store') }}" method="POST" onsubmit="return confirm('Are you sure you want to blacklist this user?');">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="text" name="reason" placeholder="Reason for blacklisting" class="border border-gray-300 px-2 py-1 rounded mb-2">
                                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Blacklist</button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection