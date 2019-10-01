<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Order extends Model
{
    protected $fillable = ['client_id', 'delivery', 'detail', 'total', 'weight'];

    protected $dates = ['delivery'];

    protected $casts = [
        'total' => 'decimal:2',
        'weight' => 'decimal:2'
    ];

    /**
     * Relationships
     */

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function articles()
    {
        return $this->hasMany('App\OrderArticle');
    }

    /**
     * Static functions
     */

    public static function filtered()
    {
        return app(Pipeline::class)
            ->send(Order::query())
            ->through([
                \App\QueryFilters\CreatedAt::class,
                \App\QueryFilters\Delivery::class
            ])
            ->thenReturn();
    }

    /**
     * Scopes
     */

     public function scopeWithDeliveryNull($query)
     {
         return $query->whereNull('delivery');
     }

     public function scopeDelivery($query, $date)
     {
         return $query->whereDate('delivery', $date);
     }

     public function scopeCreatedAt($query, $date)
     {
         return $query->whereDate('created_at', $date);
     }

    /**
    * Accessors & Mutators
    */

    public function getProfitAttribute()
    {
        return $this->articles->sum('profit');
    }

    public function getDeliveryFormattedAttribute()
    {
        return $this->delivery !== null ? $this->delivery->format('d-m-Y') : 'Inmediata';
    }
}
