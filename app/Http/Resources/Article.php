<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
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
            'name' => $this->name,
            'cost' => (float) $this->cost,
            'price' => (float) $this->price,
            // 'margin' => (float) $this->margin,
            'weight' => (float) $this->weight
        ];
    }
}
