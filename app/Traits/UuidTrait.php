<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/13/2020
 * Time: 5:44 AM
 */
namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait UuidTrait
{

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getRouteKeyName()} = (string) Uuid::generate(4);
        });
    }
}
