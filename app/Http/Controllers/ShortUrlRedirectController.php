<?php

namespace App\Http\Controllers;

use App\Repositories\ShortUrlRepository;
use Illuminate\Http\RedirectResponse;

class ShortUrlRedirectController extends Controller
{
    private ShortUrlRepository $repository;

    public function __construct()
    {
        $this->repository = new ShortUrlRepository();
    }

    public function redirect(string $slug): RedirectResponse
    {
        $destinationURL = $this->repository->getCachedDestinationUrl($slug);

        if ($destinationURL) {
            // TODO: in a job
            $this->repository->increaseHits($slug);

            return redirect($destinationURL);
        }

        abort(404);
    }
}
