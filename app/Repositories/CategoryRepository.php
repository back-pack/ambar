<?php

namespace App\Repositories;

use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryRepository
{
    public function all()
    {
        return Category::paginate(config('pagination.model.category'));
    }

    public function create(CategoryRequest $request): Category
    {
        $attributes = $request->validated();

        return Category::create($attributes);
    }

    public function update(CategoryRequest $request, Category $category): Category
    {
        $attributes = $request->validated();

        $category->update($attributes);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
