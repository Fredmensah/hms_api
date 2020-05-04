<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact',
        'token',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'contact' , 'contact');
    }


}
