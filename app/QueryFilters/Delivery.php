<?php

namespace App\QueryFilters;

class Delivery extends Filter
{
    public function applyFilter($builder)
    {
        $param = request($this->filterName());
        if ($param == 0) {
            return $builder->whereNull('delivery');
        }
        else if ($param == 1) {
            return $builder->whereNotNull('delivery');
        }
        return $builder->whereDate('delivery', $param);
    }
}
