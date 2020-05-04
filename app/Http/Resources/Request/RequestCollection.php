<?php

namespace App\Http\Resources\Request;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RequestCollection extends ResourceCollection
{
    public $collects = 'App\Http\Resources\Request\RequestResource';
}
