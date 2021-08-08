<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category)
    {
        return ArticleResource::collection(
            Article::withCount('likes', 'comments')
            ->where('category_id', $category->id)
            ->paginate(25)
        );
    }
}
