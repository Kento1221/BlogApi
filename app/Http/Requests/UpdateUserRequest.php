<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = (User::class)(Auth::user());
        return $this->user_password != null && bcrypt($this->user_password) === $user->password || $user->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_password' => 'required',
            'name' => 'nullable|string|max:100',
            'surname' => 'nullable|string|max:100',
            'email' => 'email|nullable|unique:users',
            'password' => 'nullable|string|confirmed',
            'position' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
        ];
    }
}
