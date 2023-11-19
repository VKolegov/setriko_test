<?php

namespace App\Http\Resources;

class ShortUrlsCollection extends ApiResourceCollection
{
    public $collects = ShortUrlResource::class;

}
