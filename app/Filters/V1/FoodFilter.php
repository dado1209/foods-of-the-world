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
        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }


    //get the request filters data
    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

    //filter by tags
    public function tags($value)
    {
        if (!empty($value)) {
            $this->builder->whereHas('tags', function ($query) use ($value) {
                $query->whereIn('tags.id', [$value]);
            });
        }
    }


    //filter by category
    public function category($value)
    {
        if (is_numeric($value)) {
            $this->builder->where('category_id', $value);
        } elseif (is_string($value) && $value == '!NULL') {
            $this->builder->whereNotNull('category_id');
        } elseif (is_string($value) && $value == 'NULL') {
            $this->builder->whereNull('category_id');
        }
    }

    //filter by diff_time
    public function diff_time($value)
    {   // if we get a valid diff_time value then we filter by all foods
        if (!empty($value)) {
            $this->builder->where(function ($query) use ($value) {
                $query->where('created_at', '>=', date('Y-m-d H:i:s', $value))
                    ->orWhere('updated_at', '>=', date('Y-m-d H:i:s', $value))
                    ->orWhere('deleted_at', '>=', date('Y-m-d H:i:s', $value));
            });
        }
        //else we only want to get food with created status
        else {
            $this->builder->where('status', 'created');
        }
    }
}
