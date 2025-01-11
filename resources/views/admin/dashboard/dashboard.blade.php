@extends('layouts.main')
@section('title', 'Admin Dashboard'. ' - '. $model)
@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex space-x-4 mb-6">
        <form method="GET" action="{{ route('admin.listAll') }}">
            <select name="model" class="py-2 w-64 border rounded-lg" onchange="this.form.submit()">
                <option value="Category" {{ $model === 'Category' ? 'selected' : '' }}>Category</option>
                <option value="ContactForm" {{ $model === 'ContactForm' ? 'selected' : '' }}>ContactForm</option>
                <option value="FAQItem" {{ $model === 'FAQItem' ? 'selected' : '' }}>FAQItem</option>
                <option value="FAQProposal" {{ $model === 'FAQProposal' ? 'selected' : '' }}>FAQProposal</option>
                <option value="FoodType" {{ $model === 'FoodType' ? 'selected' : '' }}>FoodType</option>
                <option value="NewsItem" {{ $model === 'NewsItem' ? 'selected' : '' }}>NewsItem</option>
                <option value="Recipe" {{ $model === 'Recipe' ? 'selected' : '' }}>Recipe</option>
                <option value="User" {{ $model === 'User' ? 'selected' : '' }}>User</option>
            </select>
        </form>
    </div>

    <div class="flex space-x-4 mb-6">
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <input type="hidden" name="model" value="{{ $model }}">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name or ID"
                class="py-2 px-4 border rounded-lg"
            >
            <button
                type="submit"
                class="py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
            >
                Filter
            </button>
        </form>

        <form method="GET" action="{{ route('admin.listAll') }}">
            <input type="hidden" name="model" value="{{ $model }}">
            <button
                type="submit"
                class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition"
            >
                List All
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($results as $item)
            <div class="bg-white p-4 rounded-lg shadow-md">
                @if ($model === 'ContactForm')
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Email: </span>{{ $item->email }}</p>
                    <p class="text-gray-600"><span class="font-bold">Message: </span>{{ $item->message }}</p>
                    <p class="text-sm text-gray-500"><span class="font-bold">Status: </span>{{ $item->status }}</p>
                    <p class="text-gray-600"><span class="font-bold">Reply: </span>{{ $item->reply ?? 'no reply yet' }}</p>
                @elseif ($model === 'FAQProposal')
                    <p class="text-gray-600"><span class="font-bold">Question: </span>{{ $item->question }}</p>
                    <p class="text-gray-600"><span class="font-bold">Answer: </span>{{ $item->answer }}</p>
                    <p class="text-gray-600"><span class="font-bold">Status: </span>{{ $item->status }}</p>
                    <p class="text-gray-600"><span class="font-bold">Category: </span>{{ $item->category->name ?? 'No category assigned or something went wrong when loading' }}</p>
                    <p class="text-gray-600"><span class="font-bold">Proposed by: </span>
                    <a href="/p/{{$item->user->id}}" class="text-amber-500 hover:text-amber-600 hover:underline"><span>@</span>{{ $item->user->name ?? 'No category assigned or something went wrong when loading' }}</a>
                    </p>
                @elseif ($model === 'FAQItem')
                    <p class="text-gray-600"><span class="font-bold">Question: </span>{{ $item->question }}</p>
                    <p class="text-gray-600"><span class="font-bold">Answer: </span>{{ $item->answer }}</p>
                    <p class="text-gray-600"><span class="font-bold">Category: </span>{{ $item->category->name ?? 'No category assigned or something went wrong when loading' }}</p>
                @elseif ($model === 'FoodType')
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Description: </span>{{ $item->description }}</p>
                @elseif ($model === 'NewsItem')
                    <p class="text-gray-600"><span class="font-bold">Title: </span>{{ $item->title }}</p>
                    <p class="text-gray-600"><span class="font-bold">Content: </span>{{ $item->content }}</p>

                    @if ($item->image)
                        <div>
                            <span class="font-bold text-gray-600">Image: </span>
                            <div class="flex items-center justify-center">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Existing Image" class="h-32 rounded-lg border border-gray-300">
                            </div>
                        </div>
                    @endif
                    <p class="text-gray-600"><span class="font-bold">Published at: </span>{{ $item->published_at->format('d F Y') }}</p>
                @elseif ($model === 'Recipe')
                    @if ($item->image)
                        <div>
                            <span class="font-bold text-gray-600">Image: </span>
                            <div class="flex items-center justify-center">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Existing Image" class="h-32 rounded-lg border border-gray-300">
                            </div>
                        </div>
                    @endif

                    <p class="text-gray-600"><span class="font-bold">Title: </span>{{ $item->title }}</p>
                    <p class="text-gray-600"><span class="font-bold">Description: </span>{{ $item->description }}</p>
                    <p class="text-gray-600"><span class="font-bold">Country: </span>{{ $item->country }}</p>
                    <hr>
                    <p class="text-gray-600"><span class="font-bold">Ingredients: </span>
                        <ul class="list-disc pl-6 text-gray-700">
                            @if($item->ingredients)
                                @foreach(json_decode($item->ingredients) as $ingredient)
                                    <li>{{ $ingredient }}</li>
                                @endforeach
                            @else
                                <li>No ingredients available.</li>
                            @endif
                        </ul>
                    </p>
                    <p class="text-gray-600"><span class="font-bold">Instructions: </span>{{ $item->instructions }}</p>

                    <p class="text-gray-600"><span class="font-bold">Food Types: </span>
                        <ul class="list-disc pl-6 text-gray-700">
                            @forelse($item->foodTypes as $foodType)
                                <li>{{ $foodType->name }}</li>
                            @empty
                                <li>No food types assigned.</li>
                            @endforelse
                        </ul>
                    </p>
                @elseif ($model === 'User')
                    @if ($item->profile_picture && file_exists(storage_path('app/public/' . $item->profile_picture)))
                        @include('components.profile-picture', ['user' => $item, 'noProfilePicture' => false])
                    @else
                        @include('components.profile-picture', ['user' => $item, 'noProfilePicture' => true])
                    @endif
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Username: </span><a href="/p/{{$item->id}}" class="text-amber-500 hover:text-amber-600 hover:underline"><span>@</span>{{ $item->username }}</a></p>
                    <p class="text-gray-600"><span class="font-bold">Username: </span>{{ $item->username }}</p>
                    <p class="text-gray-600"><span class="font-bold">Email: </span>{{ $item->email }}</p>
                    @if($item->email_verified_at)
                        <p class="text-green-600"><span class="font-bold">Email Verified: </span>{{ $item->email_verified_at->format('d F Y') }}</p>
                    @else
                        <p class="text-red-600"><span class="font-bold">Email Not Verified</span></p>
                    @endif
                    <p class="text-gray-600"><span class="font-bold">About me: </span>{{ $item->about_me }}</p>
                @else
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Description: </span>{{ $item->description }}</p>
                    <p class="text-sm text-gray-500"><span class="font-bold">Type: </span>{{ $item->type }}</p>
                @endif
                    <p class="text-sm text-gray-500"><span class="font-bold">ID: </span>{{ $item->id }}</p>
            </div>
        @empty
            <p class="text-center col-span-full text-white">No results found.</p>
        @endforelse
    </div>
</div>
@endsection