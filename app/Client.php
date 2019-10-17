<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'email'];

    /**
     * Relationships
     */

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function toSelectOption()
    {
        return [$this->id, $this->name];
    }

    public function getDebtAttribute()
    {
        $orders_total = $this->orders->sum('total');
        $payments_total = $this->payments->sum('amount');

        return $orders_total - $payments_total;
    }

    public function getHasDebtAttribute()
    {
        return $this->debt > 0;
    }
}
