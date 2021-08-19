<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $article = Article::find($this->article_id);
        return $this->user()->id == $article->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'article_id' => 'required|exists:articles',
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|nullable|string',
            'body' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|int',
            'published_at' => 'sometimes|required|date',
            'image_url' => 'sometimes|required|string'
        ];
    }
}
