<?php

namespace App\Http\Controllers;

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
        $destinationURL = $this->repository->getCachedDestinationUrl($slug);

        if ($destinationURL) {
            // TODO: in a job
            $this->repository->increaseHits($slug);

            return redirect($destinationURL);
        }

        abort(404);
    }
}
