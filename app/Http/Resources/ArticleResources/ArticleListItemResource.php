<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleListItemResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'title' => $this->title,
            'image_url' => $this->image_url,
        ];
    }
}
