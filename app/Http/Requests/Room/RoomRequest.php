<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'status' => 'nullable',
            'description' => 'nullable | string | min:3',
            'room_type_id' => 'required | exists:room_types,id',
            'image' => 'nullable | image|mimes:jpeg,png,jpg,gif,svg | max:5024',
        ];
    }
}
