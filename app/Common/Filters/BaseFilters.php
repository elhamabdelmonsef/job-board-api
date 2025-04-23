<?php

namespace App\Common\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class BaseFilters implements FiltersInterface
{
    protected $filters = [];

    public function __construct($filters= [])
    {
//        print_r($this->filters);exit;
        $this->filters = $filters;
    }


    public function apply(Builder $builder): Builder
    {
        foreach ($this->filters as $filterName => $filterValue) {
//            print_r($filterName);
            if ($methodName = $this->getFilterMethod($filterName)) {
                $this->{$methodName}($builder, $filterValue);
            }
        }

        return $builder;
    }


    protected function getFilterMethod($filterName)
    {
        //print_r($filterName);exit;
        $methodName = Str::studly($filterName);

        return method_exists($this, $methodName) ? $methodName : null;
    }

}
