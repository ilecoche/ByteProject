<?php 
namespace App\Http\Controllers;

use App\Subscribers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateSubscribersRequest;
use Request;
use Illuminate\Support\Facades\DB;

class PlacedOrdersController extends Controller {

        // Main view
	public function index()
	{
            return view('placed_orders/index');
	}
        
         public function getNestedOrderArray(){
              $undeliverdOrders = DB::table('orders')
                ->where('orders.delivered', '=', 'no')
                ->orderBy('orders.id', 'desc')
                ->get();
                   
             
              $orders = array();
              foreach($undeliverdOrders as $mc){
                  $ordered_items = DB::table('order_item')
                ->select('order_item.menu_item', 'order_item.price', 'order_item.qty')
                ->where('order_item.order_id', '=', $mc->id)
                ->orderBy('order_item.id', 'desc')
                ->get();
                  $orders[$mc->id] = $ordered_items;
              }
              return $orders;
          }
          
        
        //partial view
        public function partialorder()
        {                 
             $undeliverdOrders = DB::table('orders')
                ->where('orders.delivered', '=', 'no')
                ->orderBy('orders.id', 'desc')
                ->get();
            
              $orders = array();
              foreach($undeliverdOrders as $mc){
              
                  $orders[$mc->id] = [$mc->table_id, $mc->customer_name, $mc->total, $mc->status];
              }
            $pendingOrder = $this->getNestedOrderArray();
        
        
       
            return view('placed_orders/pending_orders_partial')->with('pendingOrder', $pendingOrder)->with('orders', $orders);
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
