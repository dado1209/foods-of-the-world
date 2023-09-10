<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Food;
use Illuminate\Support\Facades\App;

class FoodCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
    //here we will modify our pagination data
    public function paginationInformation($paginated, $default)
    {
        //convert snake case to camel case
        $meta = [
            'currentPage' => $default['meta']['current_page'],
            'totalItems' => $default['meta']['total'],
            'itemsPerPage' => $default['meta']['per_page'],
            'totalPages' => ceil($default['meta']['total']/$default['meta']['per_page'])
        ];
        return [
            'meta' => $meta,
            'data' => $paginated['data'],
            'links' => $default['links'],
        ];
    }
}
