<?php

namespace App\QueryFilters;

class CreatedAt extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->whereDate('created_at', request($this->filterName()));
    }
}
