<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResources\ArticleCommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Config;

class ArticleCommentController extends Controller
{
    /**
     * Display the specified article comments.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        return ArticleCommentResource::collection(Comment::with('user')
            ->withCount('likes')
            ->where('commentable_type', Config::get('constants.morphs.article'))
            ->where('commentable_id', $id)
            ->get());
    }
}
