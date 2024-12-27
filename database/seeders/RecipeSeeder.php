<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();
        $categories = Category::all();

        for ($i = 0; $i < 20; $i++) {
            $recipe = Recipe::create([
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'ingredients' => $faker->words(rand(5, 10), true),
                'instructions' => $faker->paragraph(),
                'image' => rand(0, 1) ? "https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" : null,
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'country' => $faker->country(),
                'preparation_time' => rand(15, 120),
            ]);
        }
    }
}
