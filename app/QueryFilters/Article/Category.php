<?php

namespace App\QueryFilters\Article;

use App\QueryFilters\Filter;

class Category extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('category_id', request($this->filterName()));
    }
}
