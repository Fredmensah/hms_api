<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'img_path',
        'discount',
        'description',
        'room_type_id',
        'price',
        'isOccupied',
    ];

    public function room_type()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id' , 'id');
    }
}
