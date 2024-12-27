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
            for ($i = 0; $i < rand(1, 5); $i++) {
                Review::create([
                    'rating' => rand(1, 5),
                    'comment' => $faker->sentence(),
                    'user_id' => $users->random()->id,
                    'recipe_id' => $recipe->id,
                ]);
            }
        }
    }
}
