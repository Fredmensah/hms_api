<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstName' => 'required | min:2 | string',
            'otherNames' => 'nullable | min:2 | string',
            'email' => 'email | required | unique:users,email',
            'contact' => 'required | string | min:9 | max: 14 | unique:users,contact',
            'password' => 'required | string | min:6',
            'password_confirmation' => 'required | min:6 | same:password'
        ];
    }
}
