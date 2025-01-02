<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        if ($recipe->reviews()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('recipes.recipe', $recipeId)
                ->with('error', 'You have already reviewed this recipe.');
        }

        $recipe->reviews()->create([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('recipes.recipe', $recipeId)
                         ->with('success', 'Review added successfully.');
    }

    public function edit($recipeId, $id)
    {
        $review = Review::where('id', $id)->where('recipe_id', $recipeId)->firstOrFail();

        return view('reviews.edit', [
            'review' => $review,
            'recipeId' => $recipeId,
        ]);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->route('recipes.recipe', $review->recipe_id)
                         ->with('success', 'Review updated successfully.');
    }

    public function destroy($recipeId, $id)
    {
        $review = Review::where('id', $id)->where('recipe_id', $recipeId)->firstOrFail();
        $review->delete();
    
        return redirect()->route('recipes.recipe', $recipeId)
                         ->with('success', 'Review deleted successfully.');
    }
}