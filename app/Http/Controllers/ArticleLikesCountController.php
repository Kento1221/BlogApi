<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleLikesCountController extends Controller
{
    public function __invoke(Article $article)
    {
        return response(['likes_count' => $article->likes()->count()]);
    }
}
