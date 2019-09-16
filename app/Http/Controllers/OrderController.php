<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderArticle;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\Order as OrderResource;
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
        $orders = Order::all();
        return view('model.order.index', compact('orders'));
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
    public function store(OrderRequest $request)
    {
        $attributes = $request->validated();

        $order = Order::create(\Arr::only($attributes, ['client_id', 'delivery', 'detail', 'total', 'weight']));

        foreach ($attributes['articles'] as $order_item) {
            $article = new \App\OrderArticle([
                'article_id' => $order_item['article']['id'],
                'quantity' => $order_item['quantity'],
                'discount' => $order_item['discount'],
                'price' => $order_item['price'],
                'is_below_cost' => $order_item['is_below_cost'],
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
    public function update(OrderRequest $request, Order $order)
    {
        $attributes = $request->validated();

        $order->update(\Arr::only($attributes, ['client_id', 'delivery', 'detail', 'total', 'weight']));

        // Get the items from the form
        $items = array_filter($attributes['articles'], function ($item) {
            return array_key_exists('id', $item);
        });

        // Get the IDs of the items from the form
        $itemIds = \Arr::pluck($items, 'id');

        // Get the IDs of the items that are already in the order
        $articleIds = \Arr::pluck($order->articles->toArray(), 'id');

        // Get the items that where deleted from the form
        $toDelete = array_diff($articleIds, $itemIds);

        // Delete the items
        OrderArticle::destroy($toDelete);

        // Update the items
        foreach ($items as $item) {
            $order_article = \App\OrderArticle::find($item['id']);
            $order_article->update([
                'article_id' => $item['article']['id'],
                'quantity' => $item['quantity'],
                'discount' => $item['discount'],
                'price' => $item['price'],
                'is_below_cost' => $item['is_below_cost'],
            ]);
        }

        // Get the items that where added in the form
        $newItems = array_filter($attributes['articles'], function ($item) {
            return !array_key_exists('id', $item);
        });

        // Create the new items
        foreach ($newItems as $item) {
            $article = new \App\OrderArticle([
                'article_id' => $item['article']['id'],
                'quantity' => $item['quantity'],
                'discount' => $item['discount'],
                'price' => $item['price'],
                'is_below_cost' => $item['is_below_cost'],
            ]);
            $order->articles()->save($article);
        }

        return $order->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->articles()->delete();
        $order->delete();
        return redirect(route('orders.index'));
    }
}
