<?php

use Illuminate\Http\Request;
use App\Article;
use App\Client;
use App\Order;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\User as UserResource;

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

Route::middleware(['auth:api'])->group(function () {

    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });

    Route::get('orders/{order}', function (Order $order) {
        return new OrderResource($order);
    });

    Route::get('articles', function (Request $request) {

        if ($request->query('search')) {
            $articles = Article::where('name', 'like', '%'.$request->query('search').'%')->orWhere('id', $request->query('search'))->take(5)->get();
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

});
