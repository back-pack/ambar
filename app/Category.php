<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function articles()
    {
        return $this->hasMany(\App\Article::class);
    }

    public function toSelectOption()
    {
        return [$this->id, $this->name];
    }

    public function getHasNoArticlesAttribute()
    {
        return $this->articles->isEmpty(); 
    }
}
