<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResourceCollection extends ResourceCollection
{
    /**
     * Customize the pagination information for the resource.
     *
     * @param Request $request
     * @param array $paginated
     * @param array $default
     * @return array
     */
    public function paginationInformation(Request $request, array $paginated, array $default): array
    {
        unset($default['links'], $default['meta']['links']);

        return $default;
    }
}