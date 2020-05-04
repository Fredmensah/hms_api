<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'name' => 'required | min:3 | unique:item_categories,name',
            'image' => 'required | image|mimes:jpeg,png,jpg,gif,svg | max:5024',
            'description' => 'nullable | string',
            'status' => 'nullable | string',
        ];
    }
}
