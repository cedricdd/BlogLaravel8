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

    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function commentsValid() {
        return$this->comments()->whereHas('user', function ($query) {
           $query->whereValid(true);
        });
    }

    public function tags() {
        return$this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
