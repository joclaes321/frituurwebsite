<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_lines';
    protected $fillable = ['price', 'product_id', 'topping_id', 'quantity', 'order_id'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function topping()
    {
        return $this->belongsTo('App\Topping');
    }
}
