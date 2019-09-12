<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_id', 'delivery', 'detail', 'total', 'weight'];

    protected $dates = ['delivery'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function articles()
    {
        return $this->hasMany('App\OrderArticle');
    }

    public function getDeliveryFormattedAttribute()
    {
        return $this->delivery !== null ? $this->delivery->format('d-m-Y') : 'Inmediata';
    }
}
