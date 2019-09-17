<?php

namespace App\Repositories;

use App\Order;
use App\OrderArticle;
use App\Http\Requests\OrderRequest;

class OrderRepository
{
    public function all()
    {
        return Order::filtered()->paginate(config('pagination.model.order'));
    }

    public function create(OrderRequest $request): Order
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

        return $order;
    }

    public function update(OrderRequest $request, Order $order): Order
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

        return $order;
    }

    public function delete(Order $order)
    {
        $order->articles()->delete();
        $order->delete();
    }
}
