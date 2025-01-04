<div class="mb-6 bg-white p-4 rounded-lg shadow-md w-fit">
    <form method="GET" action="{{ route('recipes.index') }}" class="flex flex-wrap items-center space-x-4">
        @foreach($foodTypes as $foodType)
            <div class="flex items-center space-x-2">
                <label for="food_type_{{ $foodType->id }}" class="text-sm font-medium text-gray-700">{{ $foodType->name }}</label>
                <input type="checkbox" name="food_types[]" id="food_type_{{ $foodType->id }}" value="{{ $foodType->id }}" 
                    {{ in_array($foodType->id, request()->get('food_types', [])) ? 'checked' : '' }} class="form-checkbox">
            </div>
        @endforeach

        <button type="submit" class="py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Filter</button>
    </form>
</div>


<div class="mb-6">
    <a href="{{ route('recipes.create') }}" class="inline-block py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700">
        Create Recipe
    </a>
</div>

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
                <p class="text-sm text-gray-500">
                    <span class="font-bold">Food Type:</span> {{ $recipe->foodTypes->implode('name', ', ') }}
                </p>
            </div>
            <div class="mt-4">
                <a href="{{ route('recipes.recipe', $recipe->id) }}" class="inline-block py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700">View Recipe</a>
            </div>
        </div>
    @endforeach
</div>