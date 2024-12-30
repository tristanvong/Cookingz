@extends('layouts.main')
@section('title', 'All Recipes')
@section('content')
<div class="container mx-auto mt-8 mb-8">
    <h1 class="text-2xl font-bold text-white mb-4">All Recipes</h1>
    @if($recipes->isEmpty())
        <p class="text-white">No recipes found. <a href="{{ route('recipes.create') }}" class="text-amber-500 underline">Add one now!</a></p>
    @else
        @include('components.list-recipes', ['recipes' => $recipes])
    @endif
</div>
@endsection
