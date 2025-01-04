@extends('layouts.main')
@section('title', 'My Proposals')
@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-white mb-6">My FAQ Proposals</h1>

    <div class="mb-6">
        <a href="{{ route('faq-proposals.create') }}" 
           class="inline-block py-3 px-6 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-300">
            Create one
        </a>
    </div>

    <div class="mb-6 bg-white p-4 rounded-lg shadow-md w-fit">
        @forelse ($proposals as $proposal)
            <div class="mb-4 flex flex-col space-y-2 border-b pb-4">
                <div class="text-lg font-semibold text-gray-800">Proposal Question: {{ $proposal->question }}</div>
                <div class="text-md text-gray-600">Proposal Answer: {{ $proposal->answer }}</div>
                <p class="text-sm text-gray-600">Status: <span class="font-medium">{{ ucfirst($proposal->status) }}</span></p>
            </div>
        @empty
            <p class="text-center text-gray-600">You haven't submitted any FAQ proposals yet.</p>
        @endforelse
    </div>
</div>
@endsection
