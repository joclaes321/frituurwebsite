<?php
/**
 * Created by PhpStorm.
 * User: jeffrey
 * Date: 8/15/16
 * Time: 11:38 PM
 */

namespace App\Http\ViewComposers;


use App\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class OrderViewComposer
{
    public function compose(View $view)
    {
        if (! auth()->check()) {
            return;
        }

        $user = auth()->user();
        $order = Order::with('items')->where(['user_id' => $user->id, 'order_in_progress' => true])->first();
        if ($order) {
            $view->with('order', $order);
        }
    }
}
