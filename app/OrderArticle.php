<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderArticle extends Model
{
    protected $fillable = ['order_id', 'article_id', 'price', 'quantity', 'discount', 'is_below_cost', 'name', 'cost', 'touched_price', 'weight'];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'cost' => 'decimal:2',
        'touched_price' => 'decimal:2',
        'weight' => 'decimal:2',
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

    // public function getNameAttribute()
    // {
    //     return $this->name;
    // }

    public function getTotalWeightAttribute()
    {
        return $this->weight * $this->quantity;
    }

    public function getSubtotalAttribute()
    {
        return ($this->price * $this->quantity) - (($this->discount * ($this->price * $this->quantity)) / 100);
    }

    public function getProfitAttribute()
    {
        return $this->subtotal - ($this->cost * $this->quantity);
    }

    public function getIsBelowCostAttribute()
    {
        return $this->subtotal < $this->cost * $this->quantity;
    }
}
