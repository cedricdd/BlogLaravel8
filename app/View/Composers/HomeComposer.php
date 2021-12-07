<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class HomeComposer
{
    public function compose(View $view) {
        $categoriesWithPost = Category::has('posts')->get();

        return $view->with('categories', $categoriesWithPost);
    }
}
