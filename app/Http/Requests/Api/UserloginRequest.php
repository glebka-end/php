<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserloginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //'email' => 'required|email|unique:users,email',  
             'email' => 'email',      //тут провека на email и чтобы не !совп валидация
            // 'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
          
        ];
    }
}
