<?php

namespace App\Http\Resources\ArticleResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleAuthorResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'nickname' => $this->nickname,
            'position' => $this->position,
            'description' => $this->description,
            'avatar_url' => $this->avatar_url,
            'link_to_profile' => env('APP_URL', null).'/api/user/'.$this->id,
            'created_at' => $this->created_at
        ];
    }
}
