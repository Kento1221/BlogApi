<?php

namespace App\Models;

use Http\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $hidden = ['updated_at'];
    protected $fillable = ['user_id','name', 'surname', 'position', 'description', 'nickname', 'avatar_url', 'is_active'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
