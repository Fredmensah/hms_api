<?php

namespace App\Http\Resources\Bid;

use App\Http\Resources\Request\RequestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BidResource extends JsonResource
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
            'bid' => parent::toArray($request),
            'user' => $this->user,
            'request' => new RequestResource($this->user),
        ];
    }
}
