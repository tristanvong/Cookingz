<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Category;
use App\Models\FoodType;

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

        $halal = FoodType::firstOrCreate([
            'name' => 'Halal',
            'description' => 'Halal food refers to items that are permissible under Islamic law. It excludes pork, alcohol, and any ingredients or practices that violate religious guidelines. Halal food is prepared following specific methods that ensure it is clean and ethically sourced.',
        ]);

        $vegan = FoodType::firstOrCreate([
            'name' => 'Vegan',
            'description' => 'Excludes all animal products, including meat, dairy, and eggs.',
        ]);

        $vegetarian = FoodType::firstOrCreate([
            'name' => 'Vegetarian',
            'description' => 'Excludes meat but may include dairy and eggs.',
        ]);

        for ($i = 0; $i < 20; $i++) {
            $image = rand(0, 1)
                ? 'recipe_images/placeholder.png'
                : null;

            $recipe = Recipe::create([
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'ingredients' => json_encode($faker->words(rand(5, 10))),
                'instructions' => $faker->paragraph(),
                'image' => $image,
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'country' => $faker->country(),
                'preparation_time' => rand(15, 120),
            ]);

            $foodTypes = [];

            if (rand(0, 1)) {
                $foodTypes[] = $halal->id;
            }
            if (rand(0, 1)) {
                $foodTypes[] = $vegan->id;
            }
            if (rand(0, 1)) {
                $foodTypes[] = $vegetarian->id;  
            }

            if (!empty($foodTypes)) {
                $recipe->foodTypes()->attach($foodTypes);
            }
        }
    }
}