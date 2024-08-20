<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'content',
        'title'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }
}
