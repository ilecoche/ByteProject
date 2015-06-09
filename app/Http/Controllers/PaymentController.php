<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Request;
use App\Order;


class PaymentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($order_id)
	{  
            
            return view('payment.index')->with('order_id', $order_id);
	}
        
        public function process() {
        // Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_soF49jJG1VAE4rIBq9Qoivpd");

// Get the credit card details submitted by the form
        $token = Request::input('stripeToken');
        
// Get id to create query
        $order_id = Request::input('order_id');
        
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
                        "description" => Request::input('email'))
            );
            
            
        } catch (\Stripe\Error\Card $e) {
            // The card has been declined
            dd($e);
        }
        
        
    $order->status = 'completed';
    $order->update();
        
        
        return view('payment.process');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
