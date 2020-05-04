<?php

namespace App\Models\Order;

use App\Models\Bid\Bid;
use App\Models\Request\User_Request;
use App\Models\User\User;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use SoftDeletes, UuidTrait, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'request_uuid',
        'bid_uuid',
        'request_user_uuid',
        'shipper_user_uuid',
        'amount',
        'status',
        'pickup_date',
        'arrived_date',
        'ratings',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'id',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_user_uuid', 'uuid');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'request_user_uuid', 'uuid');
    }

    public function request()
    {
        return $this->belongsTo(User_Request::class, 'request_uuid', 'uuid');
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class, 'bid_uuid', 'uuid');
    }
}
