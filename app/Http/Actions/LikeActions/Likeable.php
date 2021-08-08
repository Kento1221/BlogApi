<?php

namespace App\Http\Actions\LikeActions;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\QueryException;

class Likeable
{
    /**
     * Finds the specific likeable of certain type and returns it. If not found, returns 404.
     *
     * @param string $type
     * @param int $id
     * @return \App\Models\Interfaces\Likeable
     */
    public static function getLikeable($type, $id)
    {
        if ($type === 'article')
            return Article::findOrFail($id);
        else
            return Comment::findOrFail($id);
    }

    /**
     * Creates a new record in the likeables table inside the database
     *
     * @param \App\Models\Interfaces\Likeable $likeable
     * @param int $userId
     * @param int $likeId
     * @return \Illuminate\Http\Response
     */
    public static function storeLikeable($likeable, $userId, $likeId)
    {
        $like = new Like([
            'user_id' => $userId,
            'like_id' => $likeId
        ]);

        try {
            $saved = $likeable->likes()->save($like);
        } catch (QueryException $e) {
            return response(['success' => false], 409);
        }

        return response(['success' => true]);
    }
}
