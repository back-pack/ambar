<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Article extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'cost', 'cost_last_update', 'price', 'price_last_update', 'weight'];

    protected $dates = ['cost_last_update', 'price_last_update'];

    protected $casts = [
        'cost' => 'decimal:2',
        'weight' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public static function filtered()
    {
        return app(Pipeline::class)
            ->send(Article::query())
            ->through([
                \App\QueryFilters\Article\Category::class
            ])
            ->thenReturn();
    }

    /**
     * Accessors & Mutators
     */

    public function getCostFormatedAttribute()
    {
        return '$' . number_format($this->attributes['cost'], 2, ',', '.');
    }

    // public function getPriceAttribute()
    // {
    //     $price = (float) $this->cost + $this->margin;
    //     // $x = 5;
    //     //
    //     // return (ceil($price) % $x === 0) ? ceil($price) : round(($price + $x / 2) / $x) * $x;
    //
    //     return $price;
    // }

}
