<?php

namespace App\Http\Controllers;

use App\Models\ShortURL;
use Illuminate\Http\RedirectResponse;

class ShortURLRedirectController extends Controller
{
    public function redirect(string $slug): RedirectResponse
    {
        // cache for faster response time
        $cacheKey = "short_link_$slug";

        if ($destinationURL = \Cache::get($cacheKey)) {

            // TODO: in a job
            ShortURL::query()
                    ->where('slug', $slug)
                    ->increment('hits');

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

        $model->hits++;
        $model->save();

        return redirect(
            $model->destination_url
        );
    }
}
