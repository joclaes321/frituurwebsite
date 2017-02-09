<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['order_in_progress', 'user_id'];

    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }
}
