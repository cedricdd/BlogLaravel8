<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'slug'
    ];

    public $timestamps = FALSE;

    public function posts() {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id')->withTimestamps();
    }
}
