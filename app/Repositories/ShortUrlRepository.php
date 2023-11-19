<?php

namespace App\Repositories;

use App\Models\ShortUrl;
use Cache;
use Illuminate\Cache\TaggedCache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ShortUrlRepository
{
    public const CACHE_TAG = 'short_links';
    public const CACHE_TTL = 86400; // 24h

    public function getPaginated(int $page = 1, int $itemsPerPage = 20): LengthAwarePaginator
    {
        return ShortUrl::query()
                       ->paginate(
                           perPage: $itemsPerPage,
                           page: $page
                       );
    }

    public function getModelById(int $id): ?ShortUrl
    {
        return ShortUrl::find($id);
    }

    public function getModelBySlug(string $slug): ?ShortUrl
    {
        return ShortUrl::query()
                       ->where('slug', $slug)
                       ->first();
    }

    public function create(array $attributes): ShortUrl
    {
        $model = ShortUrl::create($attributes);

        $this->writeCache(
            slug: $model->slug,
            destinationUrl: $model->destination_url
        );

        return $model;
    }

    public function updateModelById(int $id, array $attributes): ?ShortUrl
    {
        $model = ShortUrl::find($id);

        if (!$model) {
            return null;
        }

        $model->fill($attributes)->save();

        // reset cache
        if ($model->wasChanged('destination_url')) {
            $this->resetCache($model->slug);
        }

        return $model;
    }

    public function increaseHits(string $slug): int
    {
        return ShortUrl::query()
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

        $this->writeCache($slug, $model->destination_url);

        return $model->destination_url;
    }

    /*
     * CACHE
     */
    private function taggedCache(): TaggedCache
    {
        return Cache::tags([self::CACHE_TAG]);
    }

    private function writeCache(string $slug, string $destinationUrl): void
    {
        $cacheKey = $this->getCacheKey($slug);

        $this->taggedCache()->put(
            key: $cacheKey,
            value: $destinationUrl,
            ttl: self::CACHE_TTL
        );
    }

    private function resetCache(?string $slug): void
    {
        if (!$slug) {
            $this->taggedCache()->flush();
        }

        $this->taggedCache()->forget(
            $this->getCacheKey($slug)
        );
    }

    private function getCacheKey(string $slug): string
    {
        return "short_link:$slug";
    }
}