<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class
VerifyUserAccountRequest extends FormRequest
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
            'userId' => 'required | exists:users,uuid',
            'token' => 'required | exists:verify_account_tokens,token',
            'secret' => 'required',
            'clientId' => 'required | numeric',
            'password' => 'required'
        ];
    }
}
