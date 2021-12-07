<?php

namespace Database\Seeders;

use App\Models\{Post, User, Tag, Category};
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $redactors = User::whereRole('redac')->pluck('id');
        $tags = Tag::pluck('id');
        $categories = Category::pluck('id');

        Post::withoutEvents(function () use ($redactors, $tags, $categories) {
            foreach (range(1, 9) as $i) {
                $post = Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . $i,
                    'seo_title' => 'Post ' . $i,
                    'user_id' => $redactors->random(),
                    'image' => $i . '.jpg',
                ]);

                $post->tags()->attach($tags->shuffle()->slice(0, random_int(2, $tags->count())));
                $post->categories()->attach($categories->shuffle()->slice(0, random_int(1, $categories->count())));
            }
        });
    }
}
