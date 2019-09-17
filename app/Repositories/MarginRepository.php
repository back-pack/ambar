<?php

namespace App\Repositories;

use App\Margin;
use App\Http\Requests\MarginRequest;

class MarginRepository
{
    public function all()
    {
        return Margin::paginate(config('pagination.model.margin'));
    }

    public function create(MarginRequest $request): Margin
    {
        return Margin::create($request->validated());
    }

    public function update(MarginRequest $request, Margin $margin): Margin
    {
        $margin->update($request->validated());

        return $margin;
    }

    public function delete(Margin $margin)
    {
        $margin->delete();
    }
}
