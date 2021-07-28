<?php

namespace App\Models;

use Http\Models\User;
use Http\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="likeables";
    protected $fillable=['likeable_type', 'likeable_id', 'user_id', 'like_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }

    public function likeType()
    {
        return $this->belongsTo(LikeType::class);
    }
}
