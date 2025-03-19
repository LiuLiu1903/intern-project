<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    // Relationship với Post (1 Category có nhiều Post)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
