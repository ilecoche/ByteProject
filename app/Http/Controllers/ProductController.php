<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Product;
use App\Menu_category;
use App\Http\Requests\CreateProductRequest;
use Cart;
//use ProductAdminController;
//use Request;


class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
          const TAXRATE = .13;
          
          public function getNestedArray(){
              $menu_categories = Menu_category::all();
              $products = array();
              foreach($menu_categories as $mc){
                  $productByCategory = Product::where('menu_category_id', '=', $mc['id'])->get();
                  $products[$mc['name']] = $productByCategory;
              }
              return $products;
          }


          public function currencyFormat($amount, $symbol = '$')
        {
            return $symbol . number_format( $amount, 2);
        }

        public function getIndex(){
            $products = Product::all();
            //dd($cds);
            return view('products.index')->with('products',$products);
        }
        
        
	public function index()
	{
            //$products = Product::all();
            $products = $this->getNestedArray();
            $cart = Cart::content(); 
            $subtotal = Cart::total();
            $tax = round(($subtotal * self::TAXRATE), 2);
            $total = $subtotal + $tax;
                      //dd($cds);
            return view('products.index', compact('products','cart','subtotal','tax', 'total'));
	}
	
        public function send(){
            $product = Product::find(3);
            $viewvalues = ['product' => $product];
            $dataheaders = ['to' => "ilecoche@gmail.com", 'subject' => 'Welcome'];
            Mail::send('emails.welcome',
                    $viewvalues,
                    function($message) use ($dataheaders){
                        $message->to($dataheaders['to'])
                                ->subject($dataheaders['subject']);
                    });
        }

        /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
            $product = Product::findOrFail($id);
            if(!empty($product->sku)){
              $nutrition_info = (new ProductAdminController)->nutrition($product->sku);
            } else  {
              $nutrition_info = 'Not available';
            }
           return view('products.show', compact('product', 'nutrition_info'));
  }

        
}
