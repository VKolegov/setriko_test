<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortUrlRequest;
use App\Http\Requests\PaginatedRequest;
use App\Http\Requests\UpdateShortUrlRequest;
use App\Http\Resources\ShortUrlResource;
use App\Http\Resources\ShortUrlsCollection;
use App\Repositories\ShortUrlRepository;
use Illuminate\Http\JsonResponse;

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
            page: $request->get('page', 1),
            itemsPerPage: $request->get('perPage', 20),
        );


        return new ShortUrlsCollection($paginated);
    }

    public function show(int $id): ShortUrlResource
    {
        $model = $this->repository->getModelById($id);

        if (!$model) {
            abort(404);
        }

        return new ShortUrlResource($model);
    }

    public function create(CreateShortUrlRequest $request): JsonResponse
    {
        $model = $this->repository->create(
            $request->validated()
        );

        return (new ShortUrlResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function update(int $id, UpdateShortUrlRequest $request): ShortUrlResource
    {
        $model = $this->repository->updateModelById(
            id: $id,
            attributes: $request->validated(),
        );

        if (!$model) {
            abort(404);
        }

        return new ShortUrlResource($model);
    }
}
