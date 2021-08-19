<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;

class DestroyLikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "likeable_type" => ['required', 'string',
                Rule::in([
                    Config::get('constants.morphs.article'),
                    Config::get('constants.morphs.comment')
                ])
            ],
            "likeable_id" => "required|integer",
        ];
    }
}
