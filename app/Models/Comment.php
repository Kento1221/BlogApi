<?php

namespace App\Models;

use App\Models\Interfaces\Commentable;
use App\Models\Interfaces\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements Likeable, Commentable
{
    use HasFactory;

    protected $table="commentables";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
