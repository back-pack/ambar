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
            'subtotal' => $this->subtotal,
            'is_below_cost' => $this->is_below_cost
        ];
    }
}