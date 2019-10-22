<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Article as ArticleResource;

class OrderArticle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'article' => new ArticleResource($this->article),
            'price' => floatval($this->price),
            'quantity' => floatval($this->quantity),
            'discount' => floatval($this->discount),
            'touched_price' => floatval($this->touched_price),
            'subtotal' => floatval($this->subtotal),
            'is_below_cost' => $this->is_below_cost,
            'name' => $this->name === "Sin nombre" ? $this->article->name : $this->name,
            'cost' => floatval($this->cost),
            'weight' => $this->weight,
        ];
    }
}
