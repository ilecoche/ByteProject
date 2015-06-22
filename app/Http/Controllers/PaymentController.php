<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Request;
use App\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

// TO DESTROY THE SHOPPING CART
use Cart;
//use Product;
use Gloudemans\Shoppingcart\CartCollection;
use Gloudemans\Shoppingcart\CartRowCollection;
use Gloudemans\Shoppingcart\CartRowOptionsCollection;


use Session;

class PaymentController extends Controller {
    
    // passing order id from Irinas Order controller
    public function index($order_id) {
        
        // Querys to get order related information
        $order = DB::table('orders')
                ->join('order_item', 'orders.id', '=', 'order_item.order_id')
                ->select('order_item.menu_item', 'order_item.price', 'order_item.qty')
                ->where('order_item.order_id', '=', $order_id)
                ->get();

        $bill = DB::table('orders')
                ->join('order_item', 'orders.id', '=', 'order_item.order_id')
                ->select('orders.total', 'orders.tip', 'orders.tax', 'orders.customer_name', 'orders.table_id')
                ->where('order_item.order_id', '=', $order_id)
                ->first();

        
        // return the view with order id, order array and bill array
        return view('payment.index')->with('order_id', $order_id)->with('order', $order)->with('bill', $bill);
    }

    public function process() {


        // Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_soF49jJG1VAE4rIBq9Qoivpd");

// Get the credit card details submitted by the form
        $token = Request::input('stripeToken');

// Get id to create query
        $order_id = Request::input('order_id');

// Get Email to sent online receipt
        $email = Request::input('email');

//query to get price  
        $order = order::findorFail($order_id);
        $total = $order->total;
        $tip = $order->tip;

// Create the charge on Stripe's servers - this will charge the user's card
        try {
            $charge = \Stripe\Charge::create(array(
                        "amount" => ($total + $tip) * 100, // amount in cents, again
                        "currency" => "cad",
                        "source" => $token,
                        "receipt_email" => Request::input('email'),
                        "description" => "Charge by the Byte Application at this restaurant"
                                              
            ));
            // if card is declined for several reasons
        } catch (\Stripe\Error\Card $e) {
            //get variables again if error is triggered
            $order = DB::table('orders')
                    ->join('order_item', 'orders.id', '=', 'order_item.order_id')
                    ->select('order_item.menu_item', 'order_item.price', 'order_item.qty')
                    ->where('order_item.order_id', '=', $order_id)
                    ->get();

            $bill = DB::table('orders')
                    ->join('order_item', 'orders.id', '=', 'order_item.order_id')
                    ->select('orders.total', 'orders.tip', 'orders.tax', 'orders.customer_name', 'orders.table_id')
                    ->where('order_item.order_id', '=', $order_id)
                    ->first();



            // The card has been declined for whatever reason
            return Redirect::refresh()->withFlashMessage($e->getMessage())->with('order_id', $order_id)->with('order', $order)->with('bill', $bill);
        }

        // if no errors update status order to completed
        $order->status = 'completed';
        $order->update();

        // get info of client to render in sucess page
        $bill = DB::table('orders')
                ->join('order_item', 'orders.id', '=', 'order_item.order_id')
                ->select('orders.total', 'orders.tip', 'orders.tax', 'orders.customer_name', 'orders.table_id')
                ->where('order_item.order_id', '=', $order_id)
                ->first();
        
        
        Cart::destroy();
        
        // passing bill array to view 
        return view('payment.process')->with('bill', $bill)->with('email', $email);
    }

   

}
