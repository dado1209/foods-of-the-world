<?php

namespace App\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FoodFilter
{

    protected $request;
    protected $builder;
    protected $filters = ['tags', 'category', 'diff_time'];

    //constructor
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    //apply the filters to the query
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        //if there is no diff_time value we must filter only by
        //foods with status=created
        if (!$this->request->has('diff_time')) {
            $this->builder->where('status', 'created');
        }

        // apply the rest of the filters
        //for every key check if corresponding method exists
        //ex. if we have the parameter 'category'=5
        //call the method category with the parameter value 5
        foreach ($this->getFilters() as $filter => $parameterValue) {
            if (method_exists($this, $filter)) {
                $this->$filter($parameterValue);
            }
        }

        return $this->builder;
    }


    //get the request filters data
    //gives us an array of key value pairs where
    //the key is the name of the parameter
    //ex ['category' => 5, 'tags' => 2]
    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

    //filter by tags
    //separate tags string into array by ','
    //and find all tag ids that are in this array
    public function tags($tags)
    {
        if (!empty($tags)) {
            $this->builder->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tags.id', explode(',', $tags));
            });
        }
    }


    //filter by category
    public function category($category)
    {
        if (is_numeric($category)) {
            $this->builder->where('category_id', $category);
        } elseif ($category == '!NULL') {
            $this->builder->whereNotNull('category_id');
        } elseif ($category == 'NULL') {
            $this->builder->whereNull('category_id');
        }
    }

    //filter by diff_time
    public function diff_time($time)
    {   // if we get a valid diff_time value then we filter by all foods
        if (!empty($value)) {
            $this->builder->where(function ($query) use ($time) {
                $query->where('created_at', '>=', date('Y-m-d H:i:s', $time))
                    ->orWhere('updated_at', '>=', date('Y-m-d H:i:s', $time))
                    ->orWhere('deleted_at', '>=', date('Y-m-d H:i:s', $time));
            });
        }
        //else we only want to get food with created status
        else {
            $this->builder->where('status', 'created');
        }
    }
}
