<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'content',
        'publish_date',
        'status',
    ];

    // Relationship với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //viet scope
        public function scopeNew($query)
    {
        return $query->where('status', 0);
    }

    public function scopeUpdated($query)
    {
        return $query->where('status', 1);
    }

    public function scopeHidden($query)
    {
        return $query->where('status', 2);
    }

}
