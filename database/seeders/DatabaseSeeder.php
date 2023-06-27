<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            $createdAt = $faker->dateTimeBetween('-5 years', 'now');
            $updatedAt = Carbon::instance($createdAt)->addDays(rand(1, 7));
            $paragraphs = $faker->paragraphs(5);
            $content = implode("\n\n", $paragraphs);

            Post::create([
                'user_id' => 1,
                'uuid' => $faker->uuid(),
                'title' => $faker->name(),
                'content' => $faker->text(),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);

            // Comment::create([
            //     'user_id' => 1,
            //     'post_id' => 1,
            //     'uuid' => $faker->uuid(),
            //     'content' => $faker->text(),
            //     'created_at' => $createdAt,
            //     'updated_at' => $updatedAt,
            // ]);
        }
    }
}
