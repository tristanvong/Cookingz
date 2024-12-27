<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\FAQItem;

class FAQItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::all();

        for ($i = 0; $i < 10; $i++) {
            FAQItem::create([
                'question' => $faker->sentence(),
                'answer' => $faker->paragraph(),
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
