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
            @if ($model == 'Category')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name or ID"
                class="py-2 px-4 border rounded-lg"
            >
            @elseif ($model == 'ContactForm')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name, email or ID"
                class="py-2 px-4 border rounded-lg"
            >
            @elseif ($model == 'FAQItem')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by question or ID"
                class="py-2 px-4 border rounded-lg"
            >
            @elseif ($model == 'FAQProposal')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by question or ID"
                class="py-2 px-4 border rounded-lg"
            >
            @elseif ($model == 'FoodType')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name or ID"
                class="py-2 px-4 border rounded-lg"
            >
            @elseif ($model == 'NewsItem')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by title or ID"
                class="py-2 px-4 border rounded-lg"
            >
            @elseif ($model == 'Recipe')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by title or ID"
                class="py-2 px-4 border rounded-lg"
            >
            @elseif ($model == 'User')
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by username, email or ID"
                class="py-2 px-4 border rounded-lg w-64"
            >
            @endif
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

        @if ($model == 'Category')
        <a class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition" href="/categories/create">Create Category</a>
        @elseif ($model == 'ContactForm')
        <a class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition" href="/admin/contact-forms">View Contact Forms</a>
        @elseif ($model == 'FAQItem')
        <a class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition" href="/faq/create">Create FAQ Item</a>
        @elseif ($model == 'FAQProposal')
        <!-- No need to create FAQProposal this is here for readability -->
        @elseif ($model == 'FoodType')
        <a class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition" href="{{route('foodtypes.create')}}">Create Food Type</a>
        @elseif ($model == 'NewsItem')
        <a class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition" href="/admin/news/create">Create FAQ Item</a>
        @elseif ($model == 'Recipe')
        <!-- No need to create a Recipe this is just for readability -->
        @elseif ($model == 'User')
        <a class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition" href="/admin/users/create">Create User</a>
        <a class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition" href="{{route('admin.users.index')}}">Go to User index</a>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($results as $item)
            <div class="bg-white p-4 rounded-lg shadow-md border-4 border-amber-500">
                @if ($model === 'ContactForm')
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Email: </span>{{ $item->email }}</p>
                    <p class="text-gray-600"><span class="font-bold">Message: </span>{{ $item->message }}</p>
                    <p class="text-sm text-gray-500"><span class="font-bold">Status: </span>{{ $item->status }}</p>
                    <p class="text-gray-600"><span class="font-bold">Reply: </span>{{ $item->reply ?? 'no reply yet' }}</p>
                    <div class="flex gap-4">
                        <form action="{{ route('admin.contactForms.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact form?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Delete Contact Form</button>
                        </form>
    
                        <form action="{{ route('admin.contactForms.show', $item->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to repy to this contact form?');">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Reply to this Contact Form</button>
                        </form>
                    </div>
                @elseif ($model === 'FAQProposal')
                    <p class="text-gray-600"><span class="font-bold">Question: </span>{{ $item->question }}</p>
                    <p class="text-gray-600"><span class="font-bold">Answer: </span>{{ $item->answer }}</p>
                    <p class="text-gray-600"><span class="font-bold">Status: </span>{{ $item->status }}</p>
                    <p class="text-gray-600"><span class="font-bold">Category: </span>{{ $item->category->name ?? 'No category assigned or something went wrong when loading' }}</p>
                    <p class="text-gray-600"><span class="font-bold">Proposed by: </span>
                    <a href="/p/{{$item->user->id}}" class="text-amber-500 hover:text-amber-600 hover:underline"><span>@</span>{{ $item->user->username ?? 'No category assigned or something went wrong when loading' }}</a>
                    @if($item->status === 'pending')
                        <div class="flex gap-4">
                            <form action="{{ route('faq-proposals.approve', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this faq proposal?');">
                                @csrf
                                <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Approve</button>
                            </form>
        
                            <form action="{{ route('faq-proposals.reject', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this faq proposal?');">
                                @csrf
                                <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Reject</button>
                            </form>
                        </div>
                    @endif
                    </p>
                @elseif ($model === 'FAQItem')
                    <p class="text-gray-600"><span class="font-bold">Question: </span>{{ $item->question }}</p>
                    <p class="text-gray-600"><span class="font-bold">Answer: </span>{{ $item->answer }}</p>
                    <p class="text-gray-600"><span class="font-bold">Category: </span>{{ $item->category->name ?? 'No category assigned or something went wrong when loading' }}</p>
                    <div class="flex gap-4">
                        <form action="{{ route('faqs.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this faq item?');">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Delete</button>
                        </form>
    
                        <form action="{{ route('faqs.edit', $item->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to edit this faq item?');">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Edit</button>
                        </form>
                    </div>
                @elseif ($model === 'FoodType')
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Description: </span>{{ $item->description }}</p>

                    <div class="flex gap-4">
                        <form action="{{ route('foodtypes.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this food type?');">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Delete</button>
                        </form>
    
                        <form action="{{ route('foodtypes.edit', $item->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to edit this food type?');">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Edit</button>
                        </form>
                    </div>

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
                    <div class="flex gap-4">
                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this news item?');">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Delete</button>
                        </form>
    
                        <form action="{{ route('admin.news.edit', $item->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to edit this news item?');">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Edit</button>
                        </form>
                    </div>
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
                        <ul class="list-disc pl-6 text-gray-700 mb-4">
                            @forelse($item->foodTypes as $foodType)
                                <li>{{ $foodType->name }}</li>
                            @empty
                                <li>No food types assigned.</li>
                            @endforelse
                        </ul>
                    </p>

                    <div class="flex gap-4">
                        <form action="{{ route('recipes.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Delete Recipe</button>
                        </form>
    
                        <form action="{{ route('recipes.edit', $item->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to edit this recipe?');">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Edit Recipe</button>
                        </form>
                    </div>

                @elseif ($model === 'User')
                    @if ($item->profile_picture && file_exists(storage_path('app/public/' . $item->profile_picture)))
                        @include('components.profile-picture', ['user' => $item, 'noProfilePicture' => false])
                    @else
                        @include('components.profile-picture', ['user' => $item, 'noProfilePicture' => true])
                    @endif
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Username: </span><a href="/p/{{$item->id}}" class="text-amber-500 hover:text-amber-600 hover:underline"><span>@</span>{{ $item->username }}</a></p>
                    <p class="text-gray-600"><span class="font-bold">Role: </span>{{ $item->role }}</p>
                    <p class="text-gray-600"><span class="font-bold">Email: </span>{{ $item->email }}</p>
                    @if($item->email_verified_at)
                        <p class="text-green-600"><span class="font-bold">Email Verified: </span>{{ $item->email_verified_at->format('d F Y') }}</p>
                    @else
                        <p class="text-red-600"><span class="font-bold">Email Not Verified</span></p>
                    @endif
                    <p class="text-gray-600"><span class="font-bold">About me: </span>{{ $item->about_me }}</p>
                    <div class="flex gap-4">
                        <form action="{{ route('admin.users.makeAdmin', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to give this person Admin role?');">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Give Admin</button>
                        </form>
    
                        <form action="{{ route('admin.users.revokeAdmin', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to revoke this person Admin role?');">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">Revoke Admin</button>
                        </form>
                    </div>
                @else
                    <p class="text-gray-600"><span class="font-bold">Name: </span>{{ $item->name }}</p>
                    <p class="text-gray-600"><span class="font-bold">Description: </span>{{ $item->description }}</p>
                    <p class="text-sm text-gray-500"><span class="font-bold">Type: </span>{{ $item->type }}</p>
                @endif
                    <p class="text-sm text-gray-500 mt-4"><span class="font-bold">ID: </span>{{ $item->id }}</p>
            </div>
        @empty
            <p class="text-center col-span-full text-white">No results found.</p>
        @endforelse
    </div>
</div>
@endsection