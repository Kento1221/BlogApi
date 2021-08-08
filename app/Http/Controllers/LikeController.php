<?php

namespace App\Http\Controllers;

use App\Http\Actions\LikeActions\Likeable;
use App\Http\Requests\LikeRequest;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\LikeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LikeRequest $request)
    {
        $item = Likeable::getLikeable($request['likeable_type'], $request['likeable_id']);
        $like = Likeable::storeLikeable($item, $request['user_id'], $request['like_id']);
//
        return $like;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\LikeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(LikeRequest $request)
    {
        try {
            $updated = Like::where("likeable_type", "=", $request["likeable_type"])
                ->where("likeable_id", "=", $request["likeable_id"])
                ->where("user_id", "=", $request["user_id"])->update(["like_id" => $request["like_id"]]);
        } catch (QueryException $e) {
            return response(["message" => $e->getMessage()], 409);
        }

        return $this->evaluateResult($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            "likeable_type" => "required|string",
            "likeable_id" => "required|integer",
            "user_id" => "required|integer"
        ]);
        try {
            $deleted = Like::where("likeable_type", "=", $request["likeable_type"])
                ->where("likeable_id", "=", $request["likeable_id"])
                ->where("user_id", "=", $request["user_id"])->delete();
        } catch (QueryException $e) {
            return response(["message" => $e->getMessage()], 409);
        }

        return $this->evaluateResult($deleted);
    }

    private function evaluateResult(int $result)
    {
        return $result === 1 ? response(["message" => "Ok"]) : response(["message" => "Not Found"], 404);
    }
}
