<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FAQProposal;
use Faker\Factory as Faker;
use App\Models\Category;

class FAQProposalSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        $categories = Category::where('type', 'faq')->get();

        foreach ($categories as $category) {
            $randomUser = $users->random();

            FAQProposal::create([
                'user_id' => $randomUser->id,
                'question' => $faker->sentence,
                'answer' => $faker->paragraph,
                'status' => 'pending',
                'category_id' => $category->id,
            ]);
        }

        foreach ($users as $user) {
            $numberOfProposals = rand(0, 4);

            for ($i = 0; $i < $numberOfProposals; $i++) {
                FAQProposal::create([
                    'user_id' => $user->id,
                    'question' => $faker->sentence,
                    'answer' => $faker->paragraph,
                    'status' => 'pending',
                    'category_id' => $categories->random()->id,
                ]);
            }
        }
    }
}
