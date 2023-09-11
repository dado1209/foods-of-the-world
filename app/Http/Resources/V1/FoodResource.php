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
        //set the language
        App::setLocale($request->lang);
        //array of values that we would like to know about the filtered food (tags, category, ingredients)
        $includeValues = explode(',', $request->query('with'));
        return [
            'id' => $this->id,
            'status' => $this->status,
            'title' => $this->title,
            'description' => $this->description,
            //show category, tags and ingredients if they are in the url 'with' parameter
            'category' => CategoryResource::make($this->when(in_array('category', $includeValues), $this->category)),
            'tags' => new TagCollection($this->when(in_array('tags', $includeValues), $this->tags)),
            'ingredients' => new IngredientCollection($this->when(in_array('ingredients', $includeValues), $this->ingredients))

        ];
    }
}
