<?php

namespace App\Common\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FiltersInterface
{
    public function apply(Builder $builder): Builder;
}
