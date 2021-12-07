<?php

namespace App\Services;

use App\Models\Post;

class PostService {

    /**
     * Get the previous & next post of a given post based on ID
     *
     * @param $post
     */
    public static function getPervNext($post) {

        $post->previous = Post::select('id', 'slug')
            ->whereActive(true)
            ->latest('id')
            ->firstWhere('id', '<', $post->id);

        $post->next = Post::select('id', 'slug')
            ->whereActive(true)
            ->oldest('id')
            ->firstWhere('id', '>', $post->id);
    }
}
