<?php

namespace App\Http\Controllers;

use App\Http\Actions\ImageAction;
use App\Http\Requests\ArticleImageRequest;
use App\Models\Article;
use http\Env\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArticleImageController extends Controller
{
    public function store(Article $article, ArticleImageRequest $request)
    {
        $path = ImageAction::storeImage(
            'images/articles',
            $request->file('article_image'),
            $article->slug . '-img.' . $request->file('article_image')->clientExtension());

        $article->update(['image_url' => $path]);

        return response()->success($path);
    }

    public function update(Article $article, ArticleImageRequest $request)
    {
        if($article->image_url == null) abort(409);

        $path = ImageAction::replaceImage(
            'images/articles',
            $article->image_url,
            $request->file('article_image'));

        $article->update(['image_url' => $path]);

        return response()->success($path);
    }
}

