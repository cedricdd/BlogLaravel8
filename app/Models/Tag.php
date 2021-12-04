<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag',
        'slug'
    ];

    public $timestamps = FALSE;

    public function posts() {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
