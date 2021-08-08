<?php

namespace App\Http\Actions\CommentActions;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\QueryException;

class Commentable
{
    /**
     * Finds the specific commentable of certain type and returns it. If not found, returns 404.
     *
     * @param string $type
     * @param int $id
     * @return \App\Models\Interfaces\Commentable
     */
    public static function getCommentable($type, $id)
    {
        if ($type === 'article')
            return Article::findOrFail($id);
        else
            return Comment::findOrFail($id);
    }

    /**
     * Creates a new record in the commentables table inside the database
     *
     * @param \App\Models\Interfaces\Commentable $commentable
     * @param int $userId
     * @param int $likeId
     * @return \Illuminate\Http\Response
     */
    public static function storeCommentable($commentable, $userId, $likeId)
    {
        $comment = new Comment([
            'user_id' => $userId,
            'like_id' => $likeId
        ]);

        try {
            $saved = $commentable->comments()->save($comment);
        } catch (QueryException $e) {
            return response(['success' => false], 409);
        }

        return response(['success' => true]);
    }
}
