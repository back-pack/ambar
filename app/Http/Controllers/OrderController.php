<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('model.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'client_id' => ['required', 'integer'],
            'delivery' => ['nullable', 'date'],
            'articles' => ['required', 'array', 'filled'],
            'articles.*.article.id' => ['required', 'integer'],
            'articles.*.quantity' => ['required', 'numeric'],
            'articles.*.discount' => ['required', 'numeric'],
            'detail' => ['nullable', 'string'],
            'total' => ['required', 'numeric'],
            'total_weight' => ['required', 'numeric']
        ]);

        $order = Order::create([
            'client_id' => $attributes['client_id'],
            'delivery' => $attributes['delivery'],
            'detail' => $attributes['detail'],
            'total' => $attributes['total'],
            'weight' => $attributes['total_weight']
        ]);

        foreach ($attributes['articles'] as $order_item) {
            $article = new \App\OrderArticle([
                'article_id' => $order_item['article']['id'],
                'quantity' => $order_item['quantity'],
                'discount' => $order_item['discount'],
                'price' => $order_item['price']
            ]);
            $order->articles()->save($article);
        }

        return $order->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('model.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order->load('articles.article');
        return view('model.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
