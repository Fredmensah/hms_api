<?php

namespace App\Models\System;

use App\Models\Request\User_Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item_Size extends Model
{
    use SoftDeletes;

    protected $table = 'item_sizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'img_path',
        'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    public function packages()
    {
        return $this->hasMany(User_Request::class , 'item_size_id', 'id');
    }
}
