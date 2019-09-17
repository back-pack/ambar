<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Margin extends Model
{
    protected $fillable = ['name', 'profit'];

    /**
     * Relationships
     */

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function asSelectOption()
    {
        return [$this->id, $this->name];
    }
}
