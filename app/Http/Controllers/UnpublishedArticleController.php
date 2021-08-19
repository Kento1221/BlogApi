<?php

namespace App\Http\Controllers;

use App\Models\Article;

class UnpublishedArticleController extends Controller
{
    public function update(Article $article)
    {
        $article->published_at == null
            ? $article->update(['published_at' => now()])
            : abort(422, 'Article already published');

        return response([
            'message' => 'Article: "' . $article->title . '" published successfully!',
            'article-slug' => $article->slug // for the 'show article' button that redirects to the article page
        ]);
    }

    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        return $article->restore();
    }

    public function destroy(Article $article)
    {
        return $article->delete();
    }
}
