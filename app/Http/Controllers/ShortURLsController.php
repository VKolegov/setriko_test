<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginatedRequest;
use App\Http\Resources\ShortURLResource;
use App\Repositories\ShortURLRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShortURLsController extends Controller
{
    private ShortURLRepository $repository;

    public function __construct()
    {
        $this->repository = new ShortURLRepository();
    }

    public function index(PaginatedRequest $request): AnonymousResourceCollection
    {
        $paginated = $this->repository->getPaginated(
            $request->get('page', 1),
            $request->get('perPage', 5),
        );


        return ShortURLResource::collection($paginated);
    }
}
