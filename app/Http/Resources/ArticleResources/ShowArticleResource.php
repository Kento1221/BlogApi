<?php

namespace App\Http\Resources\ArticleResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'article' => new ArticleResource($this),
            'author' => new ArticleAuthorResource($this->user),
            'category' => $this->category->name,
            'tags' => $this->tags->pluck('name'),
            'comments' => ArticleCommentResource::collection($this->comments),
        ];
    }
}
