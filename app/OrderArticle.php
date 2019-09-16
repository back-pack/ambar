<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderArticle extends Model
{
    protected $fillable = ['order_id', 'article_id', 'price', 'quantity', 'discount', 'is_below_cost'];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2'
    ];

    /**
     * Relationships
     */

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    /**
     * Accessors & Mutators
     */

    public function getNameAttribute()
    {
        return $this->article->name;
    }

    public function getWeightAttribute()
    {
        return $this->article->weight * $this->quantity;
    }

    public function getSubtotalAttribute()
    {
        return ($this->price * $this->quantity) - (($this->discount * ($this->price * $this->quantity)) / 100);
    }

    public function getIsBelowCostAttribute()
    {
        return $this->subtotal < $this->article->cost * $this->quantity;
    }
}
