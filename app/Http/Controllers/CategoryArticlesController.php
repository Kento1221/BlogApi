<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResources\ArticleResource;
use App\Models\Article;
use App\Models\Category;

class CategoryArticlesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category)
    {
        return ArticleResource::collection(
            Article::withCount('likes', 'comments')
                ->where('category_id', $category->id)
                ->where('published_at', '!=', null)
                ->paginate(25)
        );
    }
}
