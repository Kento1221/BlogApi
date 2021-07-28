<?php

namespace App\Models;

use Http\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $visible = ['name'];
    protected $fillable=['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
