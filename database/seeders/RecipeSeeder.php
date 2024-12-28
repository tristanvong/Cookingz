<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipeImagesPath = 'recipe_images';

        $files = Storage::disk('public')->files($recipeImagesPath);
        foreach ($files as $file) {
            Storage::disk('public')->delete($file);
        }

        $imagePath = 'recipe_images/placeholder.svg';
        
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $imageUrl = "https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg";
        $imageContent = file_get_contents($imageUrl);

        Storage::disk('public')->put($imagePath, $imageContent);

        $faker = Faker::create();
        $users = User::all();
        $categories = Category::all();

        for ($i = 0; $i < 20; $i++) {

            $image = rand(0, 1) 
            ? 'recipe_images/placeholder.svg'
            : null;

            $recipe = Recipe::create([
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'ingredients' => $faker->words(rand(5, 10), true),
                'instructions' => $faker->paragraph(),
                'image' => $image,
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'country' => $faker->country(),
                'preparation_time' => rand(15, 120),
            ]);
        }
    }
}
