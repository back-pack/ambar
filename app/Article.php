<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'description', 'cost', 'cost_last_update', 'margin', 'margin_last_update', 'weight'];

    protected $dates = ['cost_last_update', 'margin_last_update'];

    protected $casts = [
        'cost' => 'decimal:2',
        'weight' => 'decimal:2'
    ];

    /**
     * Accessors & Mutators
     */

    public function getCostFormatedAttribute()
    {
        return '$' . number_format($this->attributes['cost'], 2, ',', '.');
    }

}
