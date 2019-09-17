<?php

namespace App\QueryFilters;

class Delivery extends Filter
{
    public function applyFilter($builder)
    {
        $param = request($this->filterName());
        if ($param == 1) {
            return $builder->whereNull('delivery');
        }
        return $builder->whereDate('delivery', $param);
    }
}
