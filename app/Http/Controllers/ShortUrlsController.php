<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginatedRequest;
use App\Http\Resources\ShortUrlResource;
use App\Http\Resources\ShortUrlsCollection;
use App\Repositories\ShortUrlRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShortUrlsController extends Controller
{
    private ShortUrlRepository $repository;

    public function __construct()
    {
        $this->repository = new ShortUrlRepository();
    }

    public function index(PaginatedRequest $request): ShortUrlsCollection
    {
        $paginated = $this->repository->getPaginated(
            $request->get('page', 1),
            $request->get('perPage', 20),
        );


        return new ShortUrlsCollection($paginated);
    }
}
