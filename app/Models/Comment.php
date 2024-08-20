<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'author_id',
        'comment'
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
