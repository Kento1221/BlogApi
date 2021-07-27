<?php

namespace App\Models;

use Http\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable=[
        'slug','title', 'author_id', 'image_url', 'description', 'body', 'category_id', 'is_published', 'published_at'
    ];

    public function author()
    {
        return $this->hasOne(Author::class)->withDefault([
            'name'=>'Użytkownik usunięty',
            'description'=>'Informacje dotyczące autora zostały usunięte. W razie pytań skontaktuj się z naszym administratorem.
                Informacje dotyczące dróg kontaktu znajdziesz w zakładce \'Kontakt\'']);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
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

    public function count()
    {
        return $this->hasOne(ArticleCount::class)->withDefault([
            'comment_count' => 0,
            'like_count' => 0
            ]
        );
    }

}
