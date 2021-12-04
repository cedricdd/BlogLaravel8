<?php

namespace Database\Seeders;

use App\Models\
{Comment, Post, User};
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postCount = Post::count();
        $users = User::whereRole('user')->pluck('id');

        //Comments of first level
        foreach (range(1, $postCount) as $i) {
            $user_id = $users->random();

            Comment::factory()->create([
                'user_id' => $user_id,
                'post_id' => $i,
            ]);
        }

        $faker = \Faker\Factory::create();

        Comment::create([
            'post_id' => 2,
            'user_id' => 3,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 4,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                    'children' => [
                        [
                            'post_id' => 2,
                            'user_id' => 2,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                    ],
                ],
            ],
        ]);

        Comment::create([
            'post_id' => 2,
            'user_id' => 6,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 3,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                ],
                [
                    'post_id' => 2,
                    'user_id' => 6,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                    'children' => [
                        [
                            'post_id' => 2,
                            'user_id' => 3,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                            'children' => [
                                [
                                    'post_id' => 2,
                                    'user_id' => 6,
                                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        Comment::create([
            'post_id' => 4,
            'user_id' => 4,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

            'children' => [
                [
                    'post_id' => 4,
                    'user_id' => 5,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                    'children' => [
                        [   'post_id' => 4,
                            'user_id' => 2,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                        [
                            'post_id' => 4,
                            'user_id' => 1,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                    ],
                ],
            ],
        ]);
    }
}
