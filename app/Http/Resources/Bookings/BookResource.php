<?php

namespace App\Http\Resources\Bookings;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'booking' => parent::toArray($request),
            'room' => $this->room,
            'customer' => $this->customer,
            'created_by' => $this->createdBy,
        ];
    }
}
