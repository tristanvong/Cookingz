<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-4 rounded-lg shadow-md">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $recipe->title ?? '') }}" required
            class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
        @error('title')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
        <div id="ingredients-list" class="space-y-2">
            @if(isset($recipe) && $recipe->ingredients)
                @foreach(json_decode($recipe->ingredients, true) as $ingredient)
                    <div class="ingredient-input flex space-x-3">
                        <input type="text" name="ingredients[]" value="{{ $ingredient }}" class="ingredient w-64 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" required>
                        <button type="button" class="remove-ingredient bg-red-400 text-white hover:bg-red-500 focus:ring-2 focus:ring-red-300 px-4 py-2 rounded-sm transition-all duration-200 ease-in-out" onclick="removeIngredient(this)">-</button>
                    </div>
                @endforeach
            @else
                <div class="ingredient-input flex space-x-3">
                    <input type="text" name="ingredients[]" class="ingredient w-64 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" placeholder="example: 2 eggs" required>
                    <button type="button" class="remove-ingredient bg-red-400 text-white hover:bg-red-500 focus:ring-2 focus:ring-red-300 px-4 py-2 rounded-sm transition-all duration-200 ease-in-out" onclick="removeIngredient(this)">-</button>
                </div>
            @endif
        </div>
        <button type="button" id="add-ingredient" class="mt-2 bg-green-400 text-white hover:bg-green-500 focus:ring-2 focus:ring-green-300 px-4 py-2 rounded-sm transition-all duration-200 ease-in-out" onclick="addIngredient()">+</button>
    </div>

    <div>
        <label for="instructions" class="block text-sm font-medium text-gray-700">Instructions</label>
        <textarea id="instructions" name="instructions" rows="4" required
            class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
        @error('instructions')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="description" name="description" rows="4" required
            class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">{{ old('description', $recipe->description ?? '') }}</textarea>
        @error('description')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Recipe Image</label>
        @if(isset($recipe) && $recipe->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="Recipe Image" class="h-32 w-32 object-cover rounded-lg">
            </div>
        @endif
        <input type="file" id="image" name="image" accept="image/*"
            class="block w-full p-2 border border-gray-300 rounded">
        @error('image')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
        <select id="category_id" name="category_id" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>
    @if ($isEditPage)
        <div class="flex items-center space-x-2 mb-2 opacity-60 text-sm hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-red-500">
                <!--! Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com -->
                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/>
            </svg>
            <p class="text-red-500 font-semibold">
                You have to reselect the region and its country otherwise the changes won't be saved
            </p>
        </div>
    @endif

    <div class="flex space-x-4">
        <div class="flex-1">
            <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
            <select id="region" name="region" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                <option value="">Select Region</option>
                @foreach($countriesByRegion as $region => $countries)
                    <option value="{{ $region }}" {{ old('region', $recipe->region ?? '') == $region ? 'selected' : '' }}>
                        {{ $region }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1">
            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
            <select id="country" name="country" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                <option value="">Select Country</option>
                @foreach($countriesByRegion[$recipe->region ?? ''] ?? [] as $country)
                    <option value="{{ $country }}" {{ old('country', $recipe->country ?? '') == $country ? 'selected' : '' }}>
                        {{ $country }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label for="preparation_time" class="block text-sm font-medium text-gray-700">Preparation Time (in minutes)</label>
        <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time', $recipe->preparation_time ?? '') }}" required
            class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
        @error('preparation_time')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="w-full py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700">
        {{ $buttonText }}
    </button>
</form>

<script>
    document.getElementById('region').addEventListener('change', function() {
        let region = this.value;
        let countriesByRegion = @json($countriesByRegion); 

        let countrySelect = document.getElementById('country');
        countrySelect.innerHTML = '<option value="">Select Country</option>';

        if (region && countriesByRegion[region]) {
            countriesByRegion[region].forEach(function(country) {
                let option = document.createElement('option');
                option.value = country;
                option.innerHTML = country;
                countrySelect.appendChild(option);
            });
        }
    });

    function addIngredient() {
        const ingredientList = document.getElementById('ingredients-list');
        const newIngredient = document.createElement('div');
        newIngredient.classList.add('ingredient-input', 'flex', 'space-x-3');
        newIngredient.innerHTML = `
            <input type="text" name="ingredients[]" class="ingredient w-64 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" placeholder="example: 2 eggs" required>
            <button type="button" class="remove-ingredient bg-red-400 text-white hover:bg-red-500 focus:ring-2 focus:ring-red-300 px-4 py-2 rounded-sm transition-all duration-200 ease-in-out" onclick="removeIngredient(this)">-</button>
        `;
        ingredientList.appendChild(newIngredient);
    }

    function removeIngredient(button) {
        button.parentElement.remove();
    }
</script>