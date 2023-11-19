<?php

namespace App\Http\Resources;

class ShortUrlsCollection extends ApiResourceCollection
{
    public $collects = ShortURLResource::class;

}
