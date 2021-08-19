<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleCommentsCountController extends Controller
{
    public function __invoke(Article $article)
    {
        return response(['comments_count' => $article->comments()->count()]);
    }
}
