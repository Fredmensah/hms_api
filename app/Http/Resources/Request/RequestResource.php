<?php

namespace App\Http\Resources\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'request' => parent::toArray($request),
            'user' => $this->user,
            'category' => $this->category,
            'size' => $this->size,
            'bids' => $this->bids,
            'acceptedBid' => $this->acceptedBid($this->uuid),
        ];
    }
}
