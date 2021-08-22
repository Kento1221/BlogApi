<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResources\ArticleResource;
use App\Http\Resources\ArticleResources\ShowArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticleResource::collection(Article::where('published_at', '!=', null)
            ->withCount('likes', 'comments')
            ->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article($request->validated());
        $article->user_id = Auth::id();

        return $article->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ShowArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateArticleRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        return $article->update($request->validated());
    }

    /**
     * Soft delete the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        return $article->delete();
    }

    /**
     * Soft delete the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function restore(Article $article)
    {
        return $article->restore();
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy(Article $article)
    {
        return $article->forceDelete();
    }
}
