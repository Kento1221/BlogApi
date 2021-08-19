<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResources\ArticleCommentResource;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Config;

class ArticleCommentController extends Controller
{
    /**
     * Display the specified article comments.
     *
     * @param  \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Article $article)
    {
        return ArticleCommentResource::collection(Comment::with('user')
            ->withCount('likes')
            ->where('commentable_type', Config::get('constants.morphs.article'))
            ->where('commentable_id', $article->id)
            ->get()
            ->sortBy([['likes_count', 'desc'], ['created_at', 'desc']]));
    }
}
