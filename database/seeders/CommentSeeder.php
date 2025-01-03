<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\NewsItem;
use App\Models\User;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $newsItems = NewsItem::all();
        $users = User::all();

        foreach ($newsItems as $newsItem) {
            for ($i = 0; $i < rand(3, 10); $i++) {
                $user = $users->random();

                Comment::create([
                    'content' => $faker->sentence(), 
                    'user_id' => $user->id,
                    'news_item_id' => $newsItem->id,  
                ]);
            }
        }
    }
}
