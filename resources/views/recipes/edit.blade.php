@extends('layouts.main')
@section('title', 'Edit Recipe')
@section('content')
<div class="container mx-auto mt-8 mb-8">
    <h1 class="text-2xl font-bold text-white mb-4">Edit Recipe</h1>
    @include('components.recipe-form', [
        'action' => route('recipes.update', $recipe->id),
        'method' => 'PUT',
        'recipe' => $recipe,
        'categories' => $categories,
        'isEditPage' => true,
        'countriesByRegion' => $countriesByRegion,
        'buttonText' => 'Update Recipe'
    ])
</div>
@endsection