<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'description', 'price', 'price_last_update'];

    protected $dates = ['price_last_update'];

    /**
     * Accessors & Mutators
     */

    public function getPriceFormatedAttribute()
    {
        return '$' . number_format($this->attributes['price'], 2, ',', '.');
    }

}
