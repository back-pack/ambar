<?php

namespace App\QueryFilters;

use Closure;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (!request()->has($this->filterName()) || request($this->filterName()) == "") {
            return $builder;
        }

        return $this->applyFilter($builder);
    }

    protected function filterName()
    {
        return \Str::snake(class_basename($this));
    }

    protected abstract function applyFilter($builder);
}
