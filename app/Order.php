<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderedByCreatedAt', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

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

    public function payments()
    {
        return $this->hasMany('App\Payment');
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

    public function getIsFullyPaidAttribute()
    {
        return $this->total == $this->payments->sum('amount');
    }

    public function getHasDebtAttribute()
    {
        return $this->total > $this->payments->sum('amount');
    }

    public function getDebtAttribute()
    {
        return $this->total - $this->payments->sum('amount');
    }

    public function getProfitAttribute()
    {
        return $this->articles->sum('profit');
    }

    public function getDeliveryFormattedAttribute()
    {
        return $this->delivery !== null ? $this->delivery->format('d-m-Y') : 'Inmediata';
    }
}
