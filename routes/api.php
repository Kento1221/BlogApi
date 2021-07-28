<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.showBySlug');
Route::resources(['/articles' => ArticleController::class]);

Route::resources(['/authors' => AuthorController::class]);
Route::prefix('likes')->group(function (){
    Route::post('/', [LikeController::class, 'store']);
    Route::put('/', [LikeController::class, 'update']);
    Route::delete('/', [LikeController::class, 'destroy']);
});
Route::resources(['/comments' => CommentController::class]);
Route::resources(['/categories' => CategoryController::class]);
Route::resources(['/tags' => TagController::class]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
