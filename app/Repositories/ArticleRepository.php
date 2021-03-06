<?php

namespace App\Repositories;

use App\Article;
use App\Http\Requests\ArticleRequest;

class ArticleRepository
{
    public function all()
    {
        return Article::filtered();
    }

    public function create(ArticleRequest $request): Article
    {
        $attributes = $request->validated();

        $attributes['cost_last_update'] = now();
        $attributes['price_last_update'] = now();

        return Article::create($attributes);
    }

    public function update(ArticleRequest $request, Article $article): Article
    {
        $attributes = $request->validated();

        if ($request->input('cost') !== $article->cost) {
            $attributes['cost_last_update'] = now();
        }

        if ($request->input('price') !== $article->price) {
            $attributes['price_last_update'] = now();
        }

        $article->update($attributes);

        return $article;
    }

    public function delete(Article $article)
    {
        $article->delete();
    }

    public function pdf($type)
    {
        $categories = \App\Category::all();
        $articles = Article::all();
        $date = now()->format('d-m-Y');
        $filename = 'articulos_'.$date.'_'.$type.'.pdf';
        $files = \Storage::files('pdf');
        $toDownload = "pdf/{$filename}";

        if ($type == 'client') {
            $pdf = \PDF::loadView('model.article.pdf.client-list', compact('categories', 'date'));
        }
        else {
            $pdf = \PDF::loadView('model.article.pdf.list', compact('articles', 'date'));
        }

        $pdf->save(storage_path("app/pdf/{$filename}"));

        return \Storage::download($toDownload);
    }
}
