<?php

namespace App\Http\Controllers;

use App\Models\
{Category, Post, User};
use App\Services\PostService;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    protected $nbrPages;

    public function __construct() {
        $this->nbrPages = config('app.nbrPages.posts');
    }

    /**
     * Show all posts created by a given author
     */
    public function author(User $user)
    {
        $posts = Post::activeByDateForUser($user->id)->paginate($this->nbrPages);
        $title = __('Posts for author ') . '<strong>' . $user->name . '</strong>';

        return view('posts.index', compact('posts', 'title'));
    }

    /**
     * Show all posts linked to a given category
     */
    public function category(Category $category)
    {
        $posts = Post::activeByDateForCategory($category->slug)->paginate($this->nbrPages);
        $title = __('Posts for category ') . '<strong>' . $category->title . '</strong>';

        return view('posts.index', compact('posts', 'title'));
    }

    /**
     * Index page of posts
     */
    public function index() {
        $posts = Post::activeByDate()->paginate($this->nbrPages);
        $heros = Post::heros(5)->get();

        return view('posts.index', compact('posts', 'heros'));
    }

    /**
     * Show a given post by slug
     */
    public function show($slug)
    {
        $post = Post::bySlug($slug);
        PostService::getPervNext($post);

        return view('posts.show', compact('post'));
    }
}
