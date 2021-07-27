<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCount extends Model
{
    protected $table='article_counts';
    protected $fillable=['article_id','comment_count', 'like_count'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

class CommentCount extends Model
{
    protected $table='comment_counts';
    protected $fillable=['comment_id','like_count'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
