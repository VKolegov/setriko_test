<?php

namespace App\Http\Controllers;

use App\Models\ShortURL;
use App\Repositories\ShortURLRepository;
use Illuminate\Http\RedirectResponse;

class ShortURLRedirectController extends Controller
{
    private ShortURLRepository $repository;

    public function __construct()
    {
        $this->repository = new ShortURLRepository();
    }

    public function redirect(string $slug): RedirectResponse
    {
        // cache for faster response time
        $cacheKey = "short_link_$slug";

        if ($destinationURL = \Cache::get($cacheKey)) {

            // TODO: in a job
            $this->repository->increaseHits($slug);

            return redirect($destinationURL);
        }

        $model = ShortURL::query()
                         ->where('slug', $slug)
                         ->first();

        if (!$model) {
            abort(404);
        }

        \Cache::put(
            key: $cacheKey,
            value: $model->destination_url,
            ttl: 86400 // 24h
        );

        // TODO: in a job
        $this->repository->increaseHits($slug);

        return redirect(
            $model->destination_url
        );
    }
}
