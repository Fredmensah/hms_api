<?php

namespace App\Models\Bookings;

use App\Models\Room\Room;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checkIn',
        'checkOut',
        'type',
        'room_id',
        'customer_id',
        'room_discount',
        'room_type_discount',
        'price',
        'status',
        'created_by'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id' , 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id' , 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by' , 'id');
    }
}
