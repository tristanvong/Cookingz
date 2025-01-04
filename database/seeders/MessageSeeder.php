<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Message;
use Faker\Factory as Faker;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user) {
            $otherUsers = $users->where('id', '!=', $user->id);

            foreach ($otherUsers as $otherUser) {
                $messageCount = rand(1, 10);

                for ($i = 0; $i < $messageCount; $i++) {
                    $sender = $i % 2 === 0 ? $user : $otherUser;
                    $receiver = $sender->id === $user->id ? $otherUser : $user;

                    $messageType = rand(0, 1) === 0 ? 'private' : 'public'; 

                    Message::create([
                        'sender_id' => $sender->id,
                        'receiver_id' => $receiver->id,
                        'content' => $faker->sentence,
                        'type' => $messageType,
                    ]);
                }
            }
        }
    }
}
