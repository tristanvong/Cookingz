<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $recipes = Recipe::all();
        $users = User::all();

        foreach ($recipes as $recipe) {
            foreach ($users as $user) {
                $existingReview = Review::where('user_id', $user->id)
                    ->where('recipe_id', $recipe->id)
                    ->first();

                if (!$existingReview) {
                    Review::create([
                        'rating' => rand(1, 5),
                        'comment' => $faker->sentence(),
                        'user_id' => $user->id,
                        'recipe_id' => $recipe->id,
                    ]);
                }
            }
        }
    }
}
