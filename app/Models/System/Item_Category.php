<?php

namespace App\Models\System;

use App\Models\Request\User_Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item_Category extends Model
{
    use SoftDeletes;

    protected $table = 'item_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'img_path',
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
        return $this->hasMany(User_Request::class , 'item_category_id', 'id');
    }
}
