<?php

namespace App\Models\Request;

use App\Models\Bid\Bid;
use App\Models\System\Item_Category;
use App\Models\System\Item_Size;
use App\Models\User\User;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User_Request extends Model
{
    use Notifiable , UuidTrait , SoftDeletes;

    protected $table = 'user_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_uuid',
        'item_size_id',
        'item_category_id',
        'weight',
        'weight_unit',
        'status',
        'img_path',
        'description',
        'drop_location',
        'pickup_location',
        'receiver_name',
        'contact_mode',
        'contact_value',
        'delivery_date',
        'uuid',
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

    public function category()
    {
        return $this->belongsTo(Item_Category::class, 'item_category_id' , 'id');
    }

    public function size()
    {
        return $this->belongsTo(Item_Size::class, 'item_size_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid' , 'uuid');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'request_uuid' , 'uuid');
    }

    public function acceptedBid($uuid)
    {
        return Bid::where('request_uuid' , $uuid)
            ->where('status' , 'accepted')->first();
    }
}
