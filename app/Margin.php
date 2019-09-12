<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Margin extends Model
{
    protected $fillable = ['name', 'profit'];

    public function clients()
    {
        return $this->hasMany('App\Client');
    }
}
