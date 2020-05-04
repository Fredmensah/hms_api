<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
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
            'name' => 'required | min:2 | string | unique:rooms,name',
            'discount' => 'nullable',
            'status' > 'nullable',
            'image' => 'nullable | image|mimes:jpeg,png,jpg,gif,svg | max:5024',
        ];
    }
}
