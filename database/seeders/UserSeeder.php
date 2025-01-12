<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $profilePicturePath = 'profile_pictures';

        $files = Storage::disk('public')->files($profilePicturePath);
        foreach ($files as $file) {
            Storage::disk('public')->delete($file);
        }

        $placeholderImage = 'profile_pictures/placeholder.png';

        if (Storage::disk('public')->exists($placeholderImage)) {
            Storage::disk('public')->delete($placeholderImage);
        }

        $placeHolderImageAdmin = 'profile_pictures/placeholderAdmin.png';
        if (Storage::disk('public')->exists($placeHolderImageAdmin)) {
            Storage::disk('public')->delete($placeHolderImageAdmin);
        }

        $imageUrl = "https://i.imgur.com/ywWuOKK.png";
        $imageContent = file_get_contents($imageUrl);
        Storage::disk('public')->put($placeholderImage, $imageContent);

        $imageUrlAdmin = "https://i.imgur.com/OA7dxAR.png";
        $imageContentAdmin = file_get_contents($imageUrlAdmin);
        Storage::disk('public')->put($placeHolderImageAdmin, $imageContentAdmin);


        for ($i = 0; $i < 4; $i++) {

            $placeholderImage = rand(0, 1) 
            ? 'profile_pictures/placeholder.png'
            : null;

            User::create([
                'name' => $faker->name(),
                'username' => $faker->unique()->userName(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('password123'),
                'role' => User::USER,
                'date_of_birth' => $faker->dateTimeBetween('-60 years', '-13 years'),
                'about_me' => $faker->paragraph(),
                'profile_picture' => $placeholderImage,
                'privacy_mode' => $faker->boolean(),
            ]);
        }

        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => bcrypt('Password!321'),
            'role' => User::ADMIN,
            'date_of_birth' => $faker->dateTimeBetween('-60 years', '-18 years'),
            'about_me' => 'Hello, I am the admin of Cookingz. I am here to help you with any questions you might have.',
            'profile_picture' => $placeHolderImageAdmin,
            'privacy_mode' => $faker->boolean(),
        ]);
    }
}
