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
    public function paginationInformation($request, $paginated, $default)
    {
        //information that we dont want to see in the response
        unset(
            $default['meta']['links'],
            $default['meta']['path'],
            $default['meta']['to'],
            $default['meta']['from']
        );

        return $default;
    }

}
