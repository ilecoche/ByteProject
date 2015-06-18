<?php

namespace App\Http\Controllers;

use App\Order;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateSubscribersRequest;
use Request;
use Illuminate\Support\Facades\DB;

class PlacedOrdersController extends Controller {

    // Main view
    public function index() {
        return view('placed_orders/index');
    }

    // IRINA's CODE (DONT QUITE GET IT YET)
    public function getNestedOrderArray() {
        $undeliverdOrders = DB::table('orders')
                ->where('orders.delivered', '=', 'no')
                ->orderBy('orders.id', 'desc')
                ->get();


        $orders = array();
        foreach ($undeliverdOrders as $mc) {
            $ordered_items = DB::table('order_item')
                    ->select('order_item.menu_item', 'order_item.price', 'order_item.qty')
                    ->where('order_item.order_id', '=', $mc->id)
                    ->orderBy('order_item.id', 'desc')
                    ->get();
            $orders[$mc->id] = $ordered_items;
        }
        return $orders;
    }

    //partial view ORDER
    public function partialorder() {
        $undeliverdOrders = DB::table('orders')
                ->where('orders.delivered', '=', 'no')
                ->orderBy('orders.id', 'desc')
                ->get();

        $orders = array();
        foreach ($undeliverdOrders as $mc) {

            $orders[$mc->id] = [$mc->table_id, $mc->customer_name, $mc->total, $mc->status, $mc->date];
        }
        $pendingOrder = $this->getNestedOrderArray();

        return view('placed_orders/pending_orders_partial')->with('pendingOrder', $pendingOrder)->with('orders', $orders);
    }
     // IRINA's CODE (DONT QUITE GET IT YET)
    public function getNestedPaymentArray() {
        $undeliverdOrders = DB::table('orders')
                ->where('orders.delivered', '=', 'yes')
                ->where('orders.status', '=', 'pending')
                ->orderBy('orders.id', 'desc')
                ->get();


        $orders = array();
        foreach ($undeliverdOrders as $mc) {
            $ordered_items = DB::table('order_item')
                    ->select('order_item.menu_item', 'order_item.price', 'order_item.qty')
                    ->where('order_item.order_id', '=', $mc->id)
                    ->orderBy('order_item.id', 'desc')
                    ->get();
            $orders[$mc->id] = $ordered_items;
        }
        return $orders;
    }
    // PARTIAL VIEW
    public function partialpayment() {
        $undeliverdOrders = DB::table('orders')
                ->where('orders.delivered', '=', 'yes')
                ->where('orders.status', '=', 'pending')
                ->orderBy('orders.id', 'desc')
                ->get();

        $orders = array();
        foreach ($undeliverdOrders as $mc) {

            $orders[$mc->id] = [$mc->table_id, $mc->customer_name, $mc->total, $mc->status];
        }
        $pendingOrder = $this->getNestedPaymentArray();

        return view('placed_orders/pending_payment_partial')->with('pendingOrder', $pendingOrder)->with('orders', $orders);
    }
    
    // edit status of the orden when food is ready
    public function editorder() {
        $payment_id = Request::input('order_id');
        $update = Order::findorFail($payment_id);
        $update->delivered = 'yes';
        $update->update();

        return view('placed_orders/index');
    }

}
