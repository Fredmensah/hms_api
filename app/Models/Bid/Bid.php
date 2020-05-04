<?php

namespace App\Models\Bid;

use App\Models\Request\User_Request;
use App\Models\User\User;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Bid extends Model
{
    use Notifiable, UuidTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_uuid',
        'amount',
        'departure_date',
        'arrival_date',
        'request_uuid',
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

    public function user()
    {
        return $this->belongsTo(User::class , 'user_uuid' , 'uuid');
    }

    public function request()
    {
        return $this->belongsTo(User_Request::class, 'request_uuid' , 'uuid');
    }
}
