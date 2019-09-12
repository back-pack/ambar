<?php

use Illuminate\Http\Request;
use App\Article;
use App\Client;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\Client as ClientResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('articles', function (Request $request) {

    if ($request->query('search')) {
        $articles = Article::where('name', 'like', $request->query('search').'%')->get();
    } else {
        $articles = Article::all();
    }

    return ArticleResource::collection($articles);
});

Route::get('articles/{article}', function (Article $article) {
    return new ArticleResource($article);
});

Route::get('clients', function (Request $request) {
    $clients = Client::all();
    return ClientResource::collection($clients);
});
