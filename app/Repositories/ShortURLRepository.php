<?php

namespace App\Repositories;

use App\Models\ShortURL;

class ShortURLRepository
{
    public function increaseHits(string $slug): int
    {
        return ShortURL::query()
                       ->where('slug', $slug)
                       ->increment('hits');
    }
}