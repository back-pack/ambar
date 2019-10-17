<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['client_id', 'order_id', 'amount'];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
