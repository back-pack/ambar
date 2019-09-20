<?php

namespace App\Repositories;

use App\Article;
use App\Http\Requests\ArticleRequest;

class ArticleRepository
{
    public function all()
    {
        return Article::paginate(config('pagination.model.article'));
    }

    public function create(ArticleRequest $request): Article
    {
        $attributes = $request->validated();

        $attributes['cost_last_update'] = now();
        $attributes['margin_last_update'] = now();

        return Article::create($attributes);
    }

    public function update(ArticleRequest $request, Article $article): Article
    {
        $attributes = $request->validated();

        if ($request->input('cost') !== $article->cost) {
            $attributes['cost_last_update'] = now();
        }

        if ($request->input('margin') !== $article->margin) {
            $attributes['margin_last_update'] = now();
        }

        $article->update($attributes);

        return $article;
    }

    public function delete(Article $article)
    {
        $article->delete();
    }
}
