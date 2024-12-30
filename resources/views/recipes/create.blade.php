@extends('layouts.main')
@section('title', 'Create Recipe')
@section('content')
<div class="container mx-auto mt-8 mb-8">
    <h1 class="text-2xl font-bold text-white mb-4">Create Recipe</h1>
    @include('components.recipe-form', [
        'action' => route('recipes.store'),
        'method' => 'POST',
        'recipe' => null,
        'categories' => $categories,
        'isEditPage' => false,
        'countriesByRegion' => $countriesByRegion,
        'buttonText' => 'Submit Recipe'
    ])
</div>
@endsection