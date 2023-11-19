<?php

namespace App\Repositories;

use App\Models\ShortURL;
use Cache;
use Illuminate\Cache\TaggedCache;

class ShortURLRepository
{
    public const CACHE_TAG = 'short_links';
    public const CACHE_TTL = 86400; // 24h

    public function increaseHits(string $slug): int
    {
        return ShortURL::query()
                       ->where('slug', $slug)
                       ->increment('hits');
    }

    public function getCachedDestinationUrl(string $slug): ?string
    {
        $cacheKey = $this->getCacheKey($slug);

        if ($destinationURL = $this->taggedCache()->get($cacheKey)) {
            return $destinationURL;
        }

        $model = $this->getModelBySlug($slug);

        if (!$model) {
            return null;
        }

        $this->taggedCache()->put(
            key: $cacheKey,
            value: $model->destination_url,
            ttl: self::CACHE_TTL, // 24h
        );

        return $model->destination_url;
    }

    public function getModelBySlug(string $slug): ?ShortURL
    {
        return ShortURL::query()
                       ->where('slug', $slug)
                       ->first();
    }

    /*
     * CACHE
     */
    private function taggedCache(): TaggedCache
    {
        return Cache::tags([self::CACHE_TAG]);
    }

    private function getCacheKey(string $slug): string
    {
        return "short_link:$slug";
    }
}