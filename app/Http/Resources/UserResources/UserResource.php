<?php

namespace App\Http\Resources\UserResources;

use App\Http\Resources\ArticleListItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'nickname' => $this->nickname,
            'position' => $this->position,
            'description' => $this->description,
            'avatar_url' => $this->avatar_url,
            'created_at' => $this->created_at,
            'articles_count' => $this->articles_count,
            'articles' => ArticleListItemResource::collection($this->articles)
        ];
    }
}
