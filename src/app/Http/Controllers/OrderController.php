<?php
namespace App\Http\Controllers;


use App\Http\Requests\OrderItemRequest;
use App\Order;
use App\OrderItem;
use App\Product;
use App\ProductType;
use App\Topping;
use Illuminate\Http\Request;

use PDF;
use DB;
use Mail;

class OrderController extends Controller
{
    private function calculate_cost(OrderItem $order_item, int $quantity)
    {
        if (!$order_item->topping_id) {
            $topping_price = 0;
        } else {
            $topping_price = $order_item->topping->price;
        }

        $product_price = $order_item->product->price;
        return $quantity * ($product_price + $topping_price);
    }

    public function index(Request $request)
    {
        $data = [];
        $authenticated = auth()->check();
        if ($authenticated) {
            $active_category = $request->get('active_category');
            $types = ProductType::all();
            if (!$active_category && count($types) > 0) {
                $active_category = $types[0]->name;
            }

            $data['active_category'] = $active_category;
            $data['product_types'] = $types;

            // Load associated products
            $products = Product::with('toppings')->whereHas('type', function ($query) use ($active_category) {
                $query->where('name', $active_category);
            })->get();

            $data['products'] = $products;
        }

        return view('order.index')->with($data);
    }

    public function add_to_order(OrderItemRequest $request)
    {
        // See if there is an order that hasn't been fulfilled
        $user = auth()->user();

        // Let topping be NULL if it's not given
        $topping_price = 0;
        $topping_id = $request->get('topping_id');
        if ($topping_id == 0) {
            $topping_id = null;
        } else {
            $topping = Topping::find($topping_id);
            $topping_price = $topping->price;
        }

        $product_id = $request->get('product_id');
        $product = Product::find($product_id);
        $quantity = $request->get('quantity');

        // Calculate total price
        $total_price = ($topping_price + $product->price) * $quantity;

        // Add order item to order and update order price
        DB::beginTransaction();
        $order = Order::firstOrCreate(['order_in_progress' => true, 'user_id' => $user->id]);
        $order->items()->save(new OrderItem([
            'product_id' => $product_id,
            'topping_id' => $topping_id,
            'quantity' => $quantity,
            'price' => $total_price
        ]));

        DB::table('orders')->where(['id' => $order->id])->increment('price', $total_price);

        // Commit result
        DB::commit();

        return redirect()->back()->with('message', 'Toegevoegd aan order');
    }

    public function update_order(Request $request)
    {
        $item_id = $request->get('order_item_id');
        $new_quantity = $request->get('quantity');
        $item = OrderItem::find($item_id);
        $previous_price = $item->price;

        DB::beginTransaction();

        // Calculate new price
        if ($new_quantity == 0) {
            $item->delete();
            $difference = -$previous_price;
        }
        else {
            $new_price = $this->calculate_cost($item, $new_quantity);
            $difference = $new_price - $previous_price;

            $item->quantity = $new_quantity;
            $item->price = $new_price;
            $item->save();
        }

        DB::table('orders')->where(['id' => $item->order_id])->increment('price', $difference);

        DB::commit();

        return redirect()->back()->with('message', 'Order is aangepast');
    }

    public function send_order(Request $request)
    {
        $order_id = $request->get('order_id');
        $order = Order::find($order_id);
        $to_email = env('TO_EMAIL', null);
        $user = auth()->user();

        // Send email
        Mail::send('emails.order', [
            'user' => $user,
            'order' => $order
        ], function($message) use ($to_email, $user)
        {
            $message->to($to_email, 'Admin')->subject('Nieuw order van ' . $user->name);
        });

        // Update order
        $order->order_in_progress = false;
        $order->save();

        $pdf = PDF::loadView('pdf.order', [
            'order' => $order
        ]);
        return $pdf->download('order.pdf');
    }

    public function current_order()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $order = Order::where(['user_id' => $user->id, 'order_in_progress' => true])->first();
            if ($order) {
                return view('order.show');
            }
        }

        return redirect()->route('order');
    }
}
