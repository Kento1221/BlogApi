<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|unique:articles|max:255',
            'title' => 'required',
            'image_url' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'description' => 'nullable',
            'published_at' =>  'date|required_if:is_published,1'
        ];
    }
}
