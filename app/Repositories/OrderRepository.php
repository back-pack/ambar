<?php

namespace App\Repositories;

use App\Order;
use App\OrderArticle;
use App\Http\Requests\OrderRequest;

class OrderRepository
{
    public function all()
    {
        return Order::filtered();
    }

    public function create(OrderRequest $request): Order
    {
        $attributes = $request->validated();

        $order = Order::create(\Arr::only($attributes, ['client_id', 'delivery', 'detail', 'total', 'weight']));

        foreach ($attributes['articles'] as $order_item) {
            $order_article = new \App\OrderArticle([
                'article_id' => $order_item['article']['id'],
                'quantity' => $order_item['quantity'],
                'discount' => $order_item['discount'],
                'price' => $order_item['article']['price'],
                'touched_price' => $order_item['touched_price'],
                'is_below_cost' => $order_item['is_below_cost'],
                'name' =>  $order_item['article']['name'],
                'cost' =>  $order_item['article']['cost'],
                'weight' =>  $order_item['article']['weight'],
            ]);
            $order->articles()->save($order_article);
        }

        $payment_amount = $attributes['payment_amount'];

        if ($payment_amount > 0) {

            if ($payment_amount <= $order->total) {
                \App\Payment::create([
                    'client_id' => $attributes['client_id'],
                    'order_id' => $order->id,
                    'amount' => $payment_amount
                ]);
            }
            else {

                \App\Payment::create([
                    'client_id' => $attributes['client_id'],
                    'order_id' => $order->id,
                    'amount' => $order->total
                ]);

                $payment_amount -= $order->total;

                $client = \App\Client::find($attributes['client_id']);

                $orders_with_debt = $client->orders->filter->has_debt;

                foreach ($orders_with_debt as $order_with_debt) {
                    if ($payment_amount == 0) {
                            break;
                        }

                        if ($payment_amount <= $order_with_debt->debt) {
                            $amount = $payment_amount;
                        }
                        else {
                            $amount = $order_with_debt->debt;
                        }

                        \App\Payment::create([
                            'client_id' => $client->id,
                            'order_id' => $order_with_debt->id,
                            'amount' => $amount
                        ]);

                        $payment_amount -= $amount;
                }

            }

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
                'touched_price' => $item['touched_price'],
                'is_below_cost' => $item['is_below_cost'],
                'name' =>  $item['name'],
                'cost' =>  $item['cost'],
                'weight' =>  $item['weight'],
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
                'touched_price' => $item['touched_price'],
                'is_below_cost' => $item['is_below_cost'],
                'name' =>  $item['name'],
                'cost' =>  $item['cost'],
                'weight' =>  $item['weight'],
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
