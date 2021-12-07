<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'excerpt',
        'body',
        'meta_description',
        'meta_keywords',
        'active',
        'image',
        'user_id',
    ];

    /**Relations**/
    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function commentsValid() {
        return $this->comments()->whereHas('user', function ($query) {
           $query->whereValid(true);
        });
    }

    public function tags() {
        return$this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**Scopes**/
    public function scopeActive($query) {
        return $query->addSelect(
            'id',
            'slug',
            'image',
            'title',
            'excerpt',
            'user_id')
            ->with('user:id,name')
            ->whereActive(true);
    }

    public function scopeActiveByDate($query) {
        return $query->active()->latest();
    }

    public function scopeActiveByDateForUser($query, $user_id) {
        return $query->activeByDate()
            ->whereHas('user', function ($user) use($user_id) {
                $user->where('users.id', $user_id);
            });
    }

    public function scopeActiveByDateForCategory($query, $category_slug)
    {
        return $this->activeByDate()
            ->whereHas('categories', function ($category) use ($category_slug) {
                $category->where('categories.slug', $category_slug);
            });
    }

    public function scopeHeros($query, $nbr) {
        return $query->active()->with('categories')->latest('updated_at')->take($nbr);
    }

    public function scopeBySlug($query, $slug) {
        return $query->with(
            'user:id,name,email',
            'tags:id,tag,slug',
            'categories:title,slug'
        )
            ->withCount('commentsValid')
            ->whereSlug($slug)
            ->firstOrFail();
    }
}
