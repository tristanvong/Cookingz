<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Storage;

class NewsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $newsImagePath = 'news_images';

        $files = Storage::disk('public')->files($newsImagePath);
        foreach ($files as $file) {
            Storage::disk('public')->delete($file);
        }

        $placeholderImageUrl = "https://i.imgur.com/WE2ihw5.png";

        $imageContent = file_get_contents($placeholderImageUrl);
        $placeholderImagePath = $newsImagePath . '/placeholder.png';
        Storage::disk('public')->put($placeholderImagePath, $imageContent);

        for ($i = 0; $i < 5; $i++) {
            $image = rand(0, 1) ? $placeholderImagePath : null;

            NewsItem::create([
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
                'image' => $image,
                'published_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
