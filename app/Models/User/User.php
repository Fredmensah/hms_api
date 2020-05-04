<?php

namespace App\Models\User;

use App\Models\Bid\Bid;
use App\Models\Order\Order;
use App\Models\Request\User_Request;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable , HasApiTokens , HasRoles , UuidTrait , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'otherNames',
        'contact',
        'email',
        'password',
        'status',
        'idVerified',
        'uuid',
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function otp() {
        return $this->hasMany(VerifyAccountToken::class , 'user_uuid' , 'uuid');
    }

    public function passwordResets() {
        return $this->hasMany(PasswordReset::class , 'contact' , 'contact');
    }

    public function bids() {
        return $this->hasMany(Bid::class , 'user_uuid' , 'uuid');
    }

    public function requests() {
        return $this->hasMany(User_Request::class , 'user_uuid' , 'uuid');
    }

    public function myOrders() {
        return $this->hasMany(Order::class , 'request_user_uuid' , 'uuid');
    }

    public function shipOrders() {
        return $this->hasMany(Order::class , 'shipper_user_uuid' , 'uuid');
    }
}
