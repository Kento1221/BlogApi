<?php

namespace App\Models;

use App\Models\Interfaces\Commentable;
use App\Models\Interfaces\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model implements Likeable, Commentable
{
    use HasFactory, SoftDeletes;

    protected $hidden = [
        'updated_at', 'created_at', 'is_published'
    ];
    protected $fillable = [
        'slug', 'title', 'user_id', 'image_url', 'description', 'body', 'category_id', 'likes_count', 'comments_count', 'published_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
