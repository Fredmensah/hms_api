<?php

namespace App\Http\Requests\Bid;

use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
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
            'request_uuid' => 'required |exists:user_requests,uuid',
            'departureDate' => 'required | date',
            'arrivalDate' => 'required | date',
            'status' => 'nullable | string',
            'amount' => 'required | string',
        ];
    }
}
