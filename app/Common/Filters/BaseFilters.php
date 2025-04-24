<?php

namespace App\Common\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

// Base class for applying dynamic filters to Eloquent queries
abstract class BaseFilters implements FiltersInterface
{
    // Stores the filters passed in (e.g., from request)
    protected $filters = [];

    // Constructor to initialize the filters array
    public function __construct($filters = [])
    {
        // Assign filters to class property
        $this->filters = $filters;
    }

    // Applies each filter to the given Eloquent query builder
    public function apply(Builder $builder): Builder
    {
        foreach ($this->filters as $filterName => $filterValue) {
            // Get the method name corresponding to the filter key
            if ($methodName = $this->getFilterMethod($filterName)) {
                // Call the method dynamically, passing the query and value
                $this->{$methodName}($builder, $filterValue);
            }
        }

        return $builder;
    }

    // Converts a filter key (e.g., 'salary_min') to method name (e.g., 'SalaryMin')
    protected function getFilterMethod($filterName)
    {
        $methodName = Str::studly($filterName); // Converts snake_case to PascalCase

        // Check if the method exists in the child class
        return method_exists($this, $methodName) ? $methodName : null;
    }
}
