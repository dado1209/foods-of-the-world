<?php

namespace App\Http\Resources\V1;

use App\Models\Category;
use App\Models\Food;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'title' => $this->title,
            'description' => $this->description,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))

        ];
    }
}
