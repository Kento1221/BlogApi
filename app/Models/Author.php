<?php

namespace App\Models;

use Http\Models\User;
use Http\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
