<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'created_by' => 'required | exists:users,uuid',
            'request_uuid' => 'required |exists:user_requests,uuid',
            'room_id' => 'required |exists:rooms,id',
            'customer_id' => 'required |exists:users,uuid',
            'checkIn' => 'required | date',
            'checkOut' => 'required | date',
            'type' => 'required | string',
            'price' => 'required | string',
            'status' => 'nullable | string',
            'room_discount' => 'required | string',
            'room_type_discount' => 'required | string',
        ];
    }
}
