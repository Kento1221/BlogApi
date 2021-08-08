<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.showBySlug');
Route::get('/article/{id}/comments', ArticleCommentController::class)->name('article.comments');
Route::apiResource('/articles', ArticleController::class)->only(['index', 'show']);
Route::get('/articles/category/{category:name}', ArticleCategoryController::class)->name('articles.byCategory');

Route::apiResource('/users', UserController::class);

Route::delete('/likes/{id}', [LikeController::class, 'destroy']);
Route::apiResource('/like', LikeController::class)->except(['index', 'show']);

Route::apiResource('/comments', ArticleCommentController::class);
Route::apiResource('/tags', TagController::class);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/articles', ArticleController::class)->only(['store', 'update', 'destroy']);


});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
