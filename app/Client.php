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
}
