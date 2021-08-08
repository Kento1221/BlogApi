<?php

namespace App\Http\Resources\ArticleResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => [
                'avatar_url' => $this->user->avatar_url,
                'full_name' => $this->user->name.' '.$this->user->surname,
                'link_to_profile' => env('APP_URL', null).'/api/user/'.$this->user->id
            ],
            'body' => $this->body,
            'created_at' => $this->created_at,
            'likes_count' => $this->likes_count
        ];
    }
}
