<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Parent_;

class UserProfileResource extends JsonResource
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
            'user' => parent::toArray($request),
            'otp'  => $this->otp,
            'bids' => $this->bids,
            'requests' => $this->requests,
            'myOders' => $this->myOrders,
            'shippedOrders' => $this->shipOrders,
            'access' => [
                'roles' => $this->getRoleNames(),
                'permissions' => $this->getAllPermissions()
            ],
        ];
    }
}
