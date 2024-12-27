<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\NewsItem;

class NewsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            NewsItem::create([
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
                'image' => rand(0, 1) ? "https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" : null,
                'published_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
