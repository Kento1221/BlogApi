<?php

use App\Http\Controllers\ArticleApprovalController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DisapprovedArticleController;
use App\Http\Controllers\UnpublishedArticleController;
use App\Http\Controllers\UserAvatarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryArticlesController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WriterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Article by slug
Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.showBySlug');
//Article comments
Route::get('/article/{article:slug}/comments', ArticleCommentController::class)->name('article.comments');
Route::apiResource('/articles', ArticleController::class)->only(['index', 'show']);

//Articles assigned to category
Route::get('/articles/category/{category:name}', CategoryArticlesController::class)->name('articles.byCategory');

//Article tags
Route::get('/tags/{tag_name?}', [TagController::class, 'index']);
Route::apiResource('/tags', TagController::class); //TODO: finish the controller

//Article Counts
Route::get('/article/{article:slug}/likes-count', \App\Http\Controllers\ArticleLikesCountController::class);
Route::get('/article/{article:slug}/comments-count', \App\Http\Controllers\ArticleCommentsCountController::class);


Route::apiResource('/authors', WriterController::class)->only(['index', 'show']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    //User routes
    Route::apiResource('/articles', ArticleController::class)->only(['store', 'update', 'destroy']);

    //Unpublished Article
    Route::put('articles/{article}/publish', [UnpublishedArticleController::class, 'update']);
    Route::post('articles/{id}/restore', [UnpublishedArticleController::class, 'restore']);
    Route::delete('articles/{article}/destroy', [UnpublishedArticleController::class, 'destroy']);
    //Disapproved Article
    Route::post('articles/{article}/publish/renew', DisapprovedArticleController::class);

    //Comment routes
    Route::post('/article/{article:slug}/comment', [CommentController::class, 'store']);
    Route::put('/comment/{comment:id}', [CommentController::class, 'update']);
    Route::delete('/comment/{comment:id}', [CommentController::class, 'destroy']);


    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/logout-all', [AuthController::class, 'logoutAllDevices'])->name('logout-all');

        Route::post('/like', [LikeController::class, 'update'])->name('like.update');
        Route::delete('/like', [LikeController::class, 'destroy'])->name('like.destroy');

        Route::apiResource('/avatar', UserAvatarController::class)->only(['store', 'update', 'destroy']);
    });

    //Admin routes
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

        //Approval of article
        Route::apiResource('/articles/to-approval', ArticleApprovalController::class);

        Route::apiResource('/users', UserController::class)->except('store');
        Route::delete('users/force-delete/{id}', [UserController::class, 'forceDestroy'])->name('users.force-delete');
    });
});

//Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('remind', [AuthController::class, 'remindPassword']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
