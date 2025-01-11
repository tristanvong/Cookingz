@extends('layouts.main')
@section('title', 'Showing proposals of @' . $user->username)
@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-white mb-6">Showing FAQ Proposal of <a href="/p/{{$user->id}}" class="text-amber-500 hover:text-amber-600 hover:underline">@<span>{{$user->username}}</span></a></h1>

    <div class="mb-6">
        <a href="{{ route('faq-proposals.create') }}" 
           class="inline-block py-3 px-6 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-300">
            Create one
        </a>
    </div>

    <div class="mb-6 bg-white p-4 rounded-lg shadow-md w-fit">
    <x-success-message />
    <x-error-message />
        @forelse ($proposals as $proposal)
            <div class="mb-4 flex flex-col space-y-2 border-b pb-4">
                <div class="text-lg font-bold text-gray-800">Proposal ID: {{ $proposal->id }}</div>
                <div class=" text-gray-800">Proposal Question: {{ $proposal->question }}</div>
                <div class=" text-gray-800">Proposal Answer: {{ $proposal->answer }}</div>
                <p class="text-sm text-gray-600">Status: <span class="font-medium">{{ ucfirst($proposal->status) }}</span></p>
                <p class="text-sm text-gray-500">Created at: <span class="font-medium">{{$proposal->created_at }}</span></p>
                <p class="text-sm text-gray-500">Category: <span class="font-medium">{{ $proposal->category ? $proposal->category->name : 'Uncategorized' }}</span></p>
                @if (Auth::user()->role === 'admin')
                    @if ($proposal->status === 'pending')
                        <form action="{{ route('faq-proposals.approve', $proposal->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-300">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('faq-proposals.reject', $proposal->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">
                                Reject
                            </button>
                        </form>
                    @else
                        <p class="text-sm text-gray-600">Action Taken: <span class="font-medium">{{ ucfirst($proposal->status) }}</span></p>
                    @endif
                @endif
            </div>
        @empty
            <p class="text-center text-gray-600">This person hasn't submitted any FAQ proposals yet.</p>
        @endforelse
    </div>
</div>
@endsection
