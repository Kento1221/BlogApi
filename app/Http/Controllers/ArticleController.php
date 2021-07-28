<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response(Article::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\ArticleRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ArticleRequest $request)
	{
	    return Article::create($request->validated());
    }

	/**
	 * Display the specified resource.
	 *
     * @param  \App\Models\Article  $article
	 * @return \Illuminate\Http\Response
	 */
	public function show(Article $article)
	{
        return response($article->load('author', 'category', 'tags', 'comments', 'likes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$article = Article::findOrFail($id);
		$article->update($request->all());
		return response($article);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
	    $article = Article::findOrFail($id);
        $article->delete();
		return response(['message'=>'Article deleted successfully']);
	}
}
