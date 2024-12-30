<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($recipes as $recipe)
        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
            @if ($recipe->image && in_array(pathinfo($recipe->image, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp']))
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-48 h-48 object-cover mx-auto rounded-lg">
            @endif
            <div class="mt-4 flex-grow">
                <h2 class="text-lg font-bold text-gray-800">{{ $recipe->title }}</h2>
                <p class="text-sm text-gray-600">{{ Str::limit($recipe->description, 100) }}</p>
                <p class="text-sm text-gray-500 mt-2">
                    <span class="font-bold">Category:</span> {{ $recipe->category->name ?? 'Uncategorized' }}
                </p>
                <p class="text-sm text-gray-500">
                    <span class="font-bold">Country:</span> {{ $recipe->country }}
                </p>
                <p class="text-sm text-gray-500">
                    <span class="font-bold">Preparation Time:</span> {{ $recipe->preparation_time }} minutes
                </p>
                <p class="text-sm text-gray-500">
                    <span class="font-bold">By:</span> {{ $recipe->user->name }}
                </p>
            </div>
            <div class="mt-4">
                <a href="{{ route('recipe', $recipe->id) }}" class="inline-block py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700">View Recipe</a>
            </div>
        </div>
    @endforeach
</div>