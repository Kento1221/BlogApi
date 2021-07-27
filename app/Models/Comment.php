<?php

namespace App\Models;

use Http\Models\User;
use Http\Models\Article;
use Http\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table="commentables";

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function replies()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }    

    public function count()
    {
        return $this->hasOne(CommentCount::class)->withDefault([
            'like_count' => 0
            ]);
    }
    
}
