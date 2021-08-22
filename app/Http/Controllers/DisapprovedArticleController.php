<?php

namespace App\Http\Controllers;

use App\Models\Article;

class DisapprovedArticleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    //Accessible only to the author
    public function __invoke(Article $article)
    {
        return $article->restore();
    }
}
