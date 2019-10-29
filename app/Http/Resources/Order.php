<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderArticle as OrderArticleResource;

class Order extends JsonResource
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
            'client_id' => $this->client_id,
            'delivery' => $this->delivery !== null ? $this->delivery->format('Y-m-d') : null,
            'articles' => OrderArticleResource::collection($this->articles),
            'detail' => $this->detail,
            'total' => floatval($this->total),
            'weight' => floatval($this->weight)
        ];
    }
}
