<?php

namespace App\Http\Resources\Bookings;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    public $collects = 'App\Http\Resources\Bookings\BookResource';

}
