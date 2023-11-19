<?php

namespace App\Http\Resources;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortUrlResource extends JsonResource
{
    /**
     * @var ShortUrl
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->resource->id,
            'slug'            => $this->resource->slug,
            'url'             => route('short-url', ['slug' => $this->resource->slug]),
            'destination_url' => $this->resource->destination_url,
            'hits'            => $this->resource->hits,
            'name'            => $this->resource->name,
            'created_at'      => $this->resource->created_at?->toIso8601String(),
        ];
    }
}
