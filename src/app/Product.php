<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function type()
    {
        return $this->belongsTo('App\ProductType');
    }

    public function toppings()
    {
        return $this->belongsToMany('App\Topping', 'product_toppings')->withTimestamps();
    }
}
