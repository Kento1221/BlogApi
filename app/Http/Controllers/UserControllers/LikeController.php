<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Update the resource or create it if it doesn't exist in storage.
     *
     * @param \App\Http\Requests\UpdateLikeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLikeRequest $request)
    {
        $like = Like::firstOrNew([
            "likeable_type" => $request["likeable_type"],
            "likeable_id" => $request["likeable_id"],
            "user_id" => $request["user_id"]
        ]);

        if ($like->exists) {
            $result = $like->update(["like_id" => $request["like_id"]]);
        } else {
            $like->like_id = $request["like_id"];
            $result = $like->save();
        }

        return response($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\DestroyLikeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyLikeRequest $request)
    {
        $user_id = Auth::id();
        $like = Like::where("likeable_type", $request["likeable_type"])
            ->where("likeable_id", $request["likeable_id"])
            ->where("user_id", $user_id)
            ->first();

        $like ?? abort(404);
        $result = $like->delete();

        return response($result);
    }
}
