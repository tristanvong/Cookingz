@extends('layouts.main')
@section('title', 'Create Recipe')
@section('content')
<div class="container mx-auto mt-8 mb-8">
    <h1 class="text-2xl font-bold text-white mb-4">Create Recipe</h1>
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-4 rounded-lg shadow-md">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
            @error('title')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
            <div id="ingredients-list" class="space-y-2">
                <div class="ingredient-input flex space-x-3">
                    <input type="text" name="ingredients[]" class="ingredient w-64 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500" placeholder="example: 2 eggs" required>
                    <button type="button" class="remove-ingredient bg-red-400 text-white hover:bg-red-500 focus:ring-2 focus:ring-red-300 px-4 py-2 rounded-sm transition-all duration-200 ease-in-out" onclick="removeIngredient(this)">-</button>
                </div>
            </div>
            <button type="button" id="add-ingredient" class="mt-2 bg-green-400 text-white hover:bg-green-500 focus:ring-2 focus:ring-green-300 px-4 py-2 rounded-sm transition-all duration-200 ease-in-out" onclick="addIngredient()">+</button>
        </div>

        <div>
            <label for="instructions" class="block text-sm font-medium text-gray-700">Instructions</label>
            <textarea id="instructions" name="instructions" rows="4" required
                class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">{{ old('instructions') }}</textarea>
            @error('instructions')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" required
                class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Recipe Image</label>
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
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                <select id="region" name="region" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">Select Region</option>
                    @foreach($countriesByRegion as $region => $countries)
                        <option value="{{ $region }}">{{ $region }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <select id="country" name="country" class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">Select Country</option>
                </select>
            </div>
        </div>

        <div>
            <label for="preparation_time" class="block text-sm font-medium text-gray-700">Preparation Time (in minutes)</label>
            <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time') }}" required
                class="block w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
            @error('preparation_time')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="w-full py-2 px-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700">
            Submit Recipe
        </button>
    </form>
</div>

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
                option.innerHTML = `${country}`;
                countrySelect.appendChild(option);
            });
        }
    });
</script>

<script>
    function addIngredient() {
        const ingredientList = document.getElementById('ingredients-list');
        const newIngredient = document.createElement('div');
        newIngredient.classList.add('ingredient-input', 'flex', 'space-x-3');
        newIngredient.innerHTML = `
            <input type="text" name="ingredients[]" class="ingredient w-64 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="example: 2 eggs" required>
            <button type="button" class="remove-ingredient bg-red-400 text-white hover:bg-red-500 focus:ring-2 focus:ring-red-300 px-4 py-2 rounded-sm transition-all duration-200 ease-in-out" onclick="removeIngredient(this)">-</button>
        `;
        ingredientList.appendChild(newIngredient);
    }

    function removeIngredient(button) {
        button.parentElement.remove();
    }
</script>

@endsection