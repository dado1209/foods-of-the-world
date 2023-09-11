<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Http\Resources\V1\FoodCollection;
use Illuminate\Support\Facades\App;
use App\Filters\V1\FoodFilter;
use App\Http\Requests\FoodRequest;

class FoodController extends Controller
{
    protected $filter;

    // type-hint the FoodFilter class in the constructor
    public function __construct(FoodFilter $filter)
    {
        $this->filter = $filter;
    }

    public function index(FoodRequest $request)
    {
        //validation
        $request->validate;
        //filter the food
        $foods = Food::filter($this->filter);
        return new FoodCollection($foods->paginate($request->per_page)->appends($request->query()));
    }
}
