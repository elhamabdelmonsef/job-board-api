<?php

namespace App\Services;

use App\Common\Filters\BaseFilters;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;

class JobFilterService extends BaseFilters
{
    public function title(Builder $builder, $value)
    {

        return $builder->where('jobs.title', $value);
    }

    public function SalaryMin(Builder $builder, $value)
    {

        return $builder->where('jobs.salary_min', $value);
    }

    public function jobType(Builder $builder, $value)
    {
        return $builder->where('jobs.job_type', $value);
    }

    public function languages(Builder $builder, $value)
    {
        return $builder->whereHas('languages', function ($q) use ($value) {
            $q->whereIn('name', $value);
        });
    }

    public function locations(Builder $builder, $value)
    {
        return $builder->whereHas('locations', function ($q) use ($value) {
            $q->whereIn('city', $value);
        });
    }

    public function attributes(Builder $builder, $value)
    {
        foreach ($value as $attributeSlug => $conditions) {
            $builder->whereHas('attributeValues', function ($q) use ($attributeSlug, $conditions) {
                $q->whereHas('attribute', function ($subQ) use ($attributeSlug) {
                    $subQ->where('name', $attributeSlug); // or use slug if you have one
                });

                foreach ($conditions as $operator => $target) {
                    switch ($operator) {
                        case 'min':
                            $q->where('value', '>=', $target);
                            break;
                        case 'max':
                            $q->where('value', '<=', $target);
                            break;
                        case 'eq':
                            $q->where('value', $target);
                            break;
                        case 'in':
                            $q->whereIn('value', $target);
                            break;
                    }
                }
            });
        }

        return $builder;
    }

}
