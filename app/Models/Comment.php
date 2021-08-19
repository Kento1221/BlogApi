<?php

namespace App\Models;

use App\Models\Interfaces\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements Likeable
{
    use HasFactory;

    protected $table="commentables";
    protected $fillable = ['commentable_type', 'commentable_id', 'body', 'user_id'];

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
}
