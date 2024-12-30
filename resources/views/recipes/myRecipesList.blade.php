@extends('layouts.main')
@section('title', 'My Recipes')
@section('content')
<div class="container mx-auto mt-8 mb-8">
    <h1 class="text-2xl font-bold text-white mb-4">My Recipes</h1>
    @if($recipes->isEmpty())
        <p class="text-white">You have not added any recipes yet. <a href="{{ route('recipes.create') }}" class="text-amber-500 underline">Create one now!</a></p>
    @else
        @include('components.list-recipes', ['recipes' => $recipes])
    @endif
</div>
@endsection
