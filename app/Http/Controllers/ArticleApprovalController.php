<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyArticleToApprovalRequest;
use App\Http\Requests\ForceDestroyArticleToApprovalRequest;
use App\Http\Requests\StoreArticleToApprovalRequest;
use App\Http\Requests\UpdateArticleToApprovalRequest;
use App\Models\ArticleToApproval;

class ArticleApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticleToApproval::where('approved_by', null)->with('article', 'user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreArticleToApprovalRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleToApprovalRequest $request)
    {
        return ArticleToApproval::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ArticleToApproval $articleToApproval
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleToApproval $articleToApproval)
    {
        return $articleToApproval->load('user', 'article');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateArticleToApprovalRequest $request
     * @param \App\Models\ArticleToApproval $articleToApproval
     * @return \Illuminate\Http\Response
     */
    //Approve
    public function update(UpdateArticleToApprovalRequest $request, ArticleToApproval $articleToApproval)
    {
        return $articleToApproval->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\DestroyArticleToApprovalRequest $request
     * @param \App\Models\ArticleToApproval $articleToApproval
     * @return \Illuminate\Http\Response
     */
    //TODO:forcedelete the article or articleToApproval?
    public function destroy(DestroyArticleToApprovalRequest $request, ArticleToApproval $articleToApproval)
    {
        if($articleToApproval->number_of_deletes >= 3){
            return $this->forceDestroy($articleToApproval);
        }

        $articleToApproval->update(['approval_comment' => $request->validated()['approval_comment']]);
        return $articleToApproval->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ArticleToApproval $articleToApproval
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy(ArticleToApproval $articleToApproval)
    {
        return $articleToApproval->forceDelete();
    }
}
