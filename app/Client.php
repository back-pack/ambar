<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'margin_id'];

    /**
     * Relationships
     */

    public function margin()
    {
        return $this->belongsTo('App\Margin');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
