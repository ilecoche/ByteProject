<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Cart;
//use Product;
use Gloudemans\Shoppingcart\CartCollection;
use Gloudemans\Shoppingcart\CartRowCollection;
use Gloudemans\Shoppingcart\CartRowOptionsCollection;

use App\Order;
use App\Order_Item;

use App\Http\Requests\CreateOrderRequest;



class OrderController extends Controller {
    
        const TAXRATE = .13;
        
        public function currencyFormat($amount, $symbol = '$')
        {
            return $symbol . number_format( $amount, 2);
        }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $orders = DB::table('orders')->orderBy('id','asc')->get();
            $cart = Cart::content(); 
            $subtotal = Cart::total();
            $tax = round(($subtotal * self::TAXRATE), 2);
            $total = $subtotal + $tax;
            
//            $subtotal = $this->currencyFormat($subtotal);
//            $tax = $this->currencyFormat($tax);
//            $total = $this->currencyFormat($total);
            //return $cart;
            return view('orders.index', compact('orders','cart', 'subtotal' ,'tax' ,'total'));
	}
        
        /**
         * Get orders by date.
         * 
         */
        public function ordersByDate($orderdate){
            $orders = DB::table('orders')->where('date', '=', $orderdate)->orderBy('id','asc')->get();
            return view('orders.index')->with('orders',$orders);
        }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $now = Carbon::now()->format('Y-m-d');
            $order_no = Order::orderBy('id','desc')->first();
            if(!is_null($order_no)){
                $order_no = $order_no->id + 1;
            }
            else {
                $order_no = 0;
            }
            $order_no = str_pad($order_no, 12, '0', STR_PAD_LEFT);

            $cart = Cart::content(); 
            $subtotal = Cart::total();
            $tax = round(($subtotal * self::TAXRATE), 2);
            $total = $subtotal + $tax;
            
//            $subtotal = $this->currencyFormat($subtotal);
//            $tax = $this->currencyFormat($tax);
//            $total = $this->currencyFormat($total);
            //return $cart;
            return view('orders.checkout', compact('now', 'order_no', 'cart', 'subtotal' ,'tax' ,'total'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateOrderRequest $request)
	{
//            $this->validate($request,
//                        [
//                            'customer_name' => 'required|min:5',
//                            'tip' => 'required|between:0,999.99',
//                            'table_id' => 'required|between:1,10'
//
//                        ]
//                        );
            $input = $request->all();

            $order = new Order;
                    
                $order->order_no = $input['order_no'];
                $order->date = $input['date'];
                $order->status = $input['status'];
                $order->total = $input['total'];
                $order->tip = $input['tip'];
                $order->table_id = $input['table_id'];
                $order->type = $input['type'];
                $order->customer_name = $input['customer_name'];
                $order->tax = $input['tax'];
                    
                $order->save();
                $order_id = $order->id;
                
            //$order_items = array($input['menu_item'], $input['qty'], $input['price']);
                
                $cart = Cart::content(); 
                $subtotal = Cart::total();
                $tax = round(($subtotal * self::TAXRATE), 2);
                $total = $subtotal + $tax;
                
//            $menu_items = $input['menu_item'];
//            $qtys = $input['qty'];
//            $prices = $input['price'];
            
 //           for( $i=0; $i<count($menu_items); $i++ ){
                foreach($cart as $row){
            $order_item = new Order_item;
            
                $order_item->order_id = $order_id;
                $order_item->menu_item = $row['name'];
                $order_item->qty = $row['qty'];
                $order_item->price = $row['price'];
            $order_item->save();   
            }
             return redirect('payment/'. $order_id);
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
