<?php

namespace App\Services;

use App\Common\Filters\BaseFilters;
use Illuminate\Database\Eloquent\Builder;

class JobFilterService extends BaseFilters
{
    // Filter by job title using a partial match (LIKE)
    public function title(Builder $builder, $value)
    {
        return $builder->where('jobs.title', 'LIKE', "%{$value}%");
    }

    // Filter by job description using a partial match (LIKE)
    public function description(Builder $builder, $value)
    {
        return $builder->where('jobs.description', 'LIKE', "%{$value}%");
    }

    // Filter by company name using a partial match (LIKE)
    public function companyName(Builder $builder, $value)
    {
        return $builder->where('jobs.company_name', 'LIKE', "%{$value}%");
    }

    // Filter by boolean value (is_remote), converting string like "true"/"false" to boolean
    public function isRemote(Builder $builder, $value)
    {
        return $builder->where('jobs.is_remote', filter_var($value, FILTER_VALIDATE_BOOLEAN));
    }

    // Filter by job type, supports single or multiple values (array)
    public function jobType(Builder $builder, $value)
    {
        if (is_array($value)) {
            return $builder->whereIn('jobs.job_type', $value);
        }

        return $builder->where('jobs.job_type', $value);
    }

    // Filter jobs based on languages relation (many-to-many)
    public function languages(Builder $builder, $value)
    {
        return $builder->whereHas('languages', function ($q) use ($value) {
            $q->whereIn('name', $value);
        });
    }

    // Filter jobs based on locations relation (many-to-many)
    public function locations(Builder $builder, $value)
    {
        return $builder->whereHas('locations', function ($q) use ($value) {
            $q->whereIn('city', $value);
        });
    }

    // Filter salary_min field using numeric conditions
    public function salaryMin(Builder $builder, $value)
    {
        return $this->applyNumericConditions($builder, 'salary_min', $value);
    }

    // Filter salary_max field using numeric conditions
    public function salaryMax(Builder $builder, $value)
    {
        return $this->applyNumericConditions($builder, 'salary_max', $value);
    }

    // Filter EAV (Entity Attribute Value) attributes dynamically
    public function attributes(Builder $builder, $value)
    {
        foreach ($value as $attributeSlug => $conditions) {
            $builder->whereHas('attributeValues', function ($q) use ($attributeSlug, $conditions) {
                // Filter by attribute name
                $q->whereHas('attribute', function ($subQ) use ($attributeSlug) {
                    $subQ->where('name', $attributeSlug);
                });

                // Apply filtering conditions to attribute values
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

    // Shared method to apply numeric filter conditions to specific fields
    protected function applyNumericConditions(Builder $builder, string $field, $value)
    {
        if (is_array($value)) {
            foreach ($value as $operator => $target) {
                switch ($operator) {
                    case '=':
                    case 'eq':    // Equal to
                        $builder->where("jobs.$field", '=', $target);
                        break;
                    case '!=':
                    case 'neq':   // Not equal to
                        $builder->where("jobs.$field", '!=', $target);
                        break;
                    case '>':     // Greater than
                        $builder->where("jobs.$field", '>', $target);
                        break;
                    case '<':     // Less than
                        $builder->where("jobs.$field", '<', $target);
                        break;
                    case '>=':    // Greater than or equal
                        $builder->where("jobs.$field", '>=', $target);
                        break;
                    case '<=':    // Less than or equal
                        $builder->where("jobs.$field", '<=', $target);
                        break;
                    case 'in':    // Value is in list
                        $builder->whereIn("jobs.$field", $target);
                        break;
                }
            }
        } else {
            // If not an array, use simple equality filter
            $builder->where("jobs.$field", '=', $value);
        }

        return $builder;
    }
}
