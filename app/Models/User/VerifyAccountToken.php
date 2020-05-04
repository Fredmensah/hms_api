<?php

namespace App\Models\User;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerifyAccountToken extends Model
{
    use SoftDeletes , UuidTrait;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_uuid',
        'token',
    ];

    public function user() {
        return $this->belongsTo(User::class , 'user_uuid' , 'uuid');
    }
}
