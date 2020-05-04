<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class User_Request extends FormRequest
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
            'user_uuid' => 'required | exists:users,uuid',
            'itemSize' => 'required |exists:item_sizes,id| numeric',
            'itemCategory' => 'required |exists:item_categories,id| numeric',
            'weight' => 'string | nullable',
            'weightUnit' => 'nullable | string',
            'image' => 'required | image|mimes:jpeg,png,jpg,gif,svg | max:5024',
            'description' => 'nullable | string',
            'dropLocation' => 'required | string',
            'pickupLocation' => 'required | string',
            'receiverName' => 'required | string',
            'contactMode' => 'required | string',
            'contactValue' => 'required | string',
            'deliveryDate' => 'required | date',
            'status' => 'nullable | string',
        ];
    }
}
