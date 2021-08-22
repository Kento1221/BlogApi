<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
//TODO: form validate the class
    /**
     * Update the resource or create it if it doesn't exist in storage.
     *
     * @param \App\Http\Requests\UpdateLikeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'commentable_type' => [
                'required',
                'string',
                Rule::in([
                    Config::get('constants.morphs.article'),
                    Config::get('constants.morphs.comment')
                ])
            ],
            'commentable_id' => 'required|integer',
            'body' => 'required|string|max:255'
        ]);
        $validated['user_id'] = Auth::id();
        return Comment::create($validated);
    }

    /**
     * Update the resource or create it if it doesn't exist in storage.
     *
     * @param \App\Models\Comment $comment
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment, Request $request)
    {
        $validated = $this->validate($request, [
            'body' => 'required|string|max:255'
        ]);

        return $comment->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}
