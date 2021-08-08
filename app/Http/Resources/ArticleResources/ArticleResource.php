<?php

namespace App\Http\Resources\ArticleResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'like_count' => $this->likes_count,
            'comment_count' => $this->comments_count
        ];
    }
}
