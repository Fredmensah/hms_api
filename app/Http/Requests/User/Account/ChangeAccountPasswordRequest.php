<?php

namespace App\Http\Requests\User\Account;

use Illuminate\Foundation\Http\FormRequest;

class ChangeAccountPasswordRequest extends FormRequest
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
            'currentPassword' => 'required | string | min:6',
            'password' => 'required | string | min:6',
            'passwordConfirmation' => 'required | min:6 | same:password'
        ];
    }
}
