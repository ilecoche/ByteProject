<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Product;
use App\Menu_category;
use App\Http\Requests\CreateProductRequest;
use Session;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;



class ProductAdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    const NDBKEY = '7nEAe6LI7yfT7R4IxPjZSafCpqNUZGz2FU27MugY';
 
    /*
    * For nutritionix API 
    define('APIID', '64b969ff');
    define('APIKEY', 'f60dabd6813bc369c33a870880947859');
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    // function to get products grouped by categories
    public function getNestedArray(){
              $menu_categories = Menu_category::all();
              $products = array();
              foreach($menu_categories as $mc){
                  $productByCategory = Product::where('menu_category_id', '=', $mc['id'])->get();
                  if(count($productByCategory)){
                    $products[$mc['name']] = $productByCategory;
                  }
              }
              return $products;
          }

    // function to get products to display and message if new product was added
	public function index()
	{
            
            $products = $this->getNestedArray();
            $message = Session::get('msg');
            return view('products_admin.index', compact('products', 'message'));
	}

    // function to get nutrition info based on ndbno number returned by API food search
    public function nutrition($ndbno)
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://api.nal.usda.gov/ndb/']);

        // Request to http://api.nal.usda.gov/ndb/reports/?ndbno=01009&type=f&format=json&api_key=7nEAe6LI7yfT7R4IxPjZSafCpqNUZGz2FU27MugY
        $response = $client->get('http://api.nal.usda.gov/ndb/reports', [
            'query' => [
                'ndbno' => $ndbno,
                'type' => 'f',
                'format' => 'json',
                'api_key' => self::NDBKEY
            ]
        ]);
        $body = json_decode($response->getBody());
        $selectedfood = $body->report->food->name;

        // get first 10 elements of the array, the rest are vitamins and microelements
        $nutrients = array_slice($body->report->food->nutrients , 0, 9);
        
        return view('products_admin.nutrition', compact('selectedfood','nutrients'));
    }
    
    // function to get ndbno number from food search result list selected by user
    public function usdanumber(Request $request){
        $input = $request->all();
        $searchstring = $input['s'];

    //Request to http://api.nal.usda.gov/ndb/search/?format=json&q=pizza%20thin%20crust&sort=n&max=25&offset=0&api_key=7nEAe6LI7yfT7R4IxPjZSafCpqNUZGz2FU27MugY
    // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://api.nal.usda.gov/ndb/']);
        try {

            $response = $client->get('http://api.nal.usda.gov/ndb/search', [
                'query' => [
                    'format' => 'json',
                    'q' => $searchstring,
                    'sort' => 'r',
                    'max' => '10',
                    'offeset' => '0',
                    'api_key' => self::NDBKEY
                ]
            ]);
                $body = json_decode($response->getBody());
                $foods = $body->list->item;
                return view('products_admin.usdanumber', compact('foods'));        
        } catch (ClientException $e) {
             
             return "No foods found matching your search";

        }

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $menu_categories = Menu_category::lists('name', 'id');
        
        return view('products_admin.create', compact('menu_categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
        
        public function store(CreateProductRequest $request)
	{
            
            
             $product = new Product(array(
                'dish' => $request->get('dish'),
                'sku'  => $request->get('sku'),
                'menu_category_id' => $request->get('menu_category_id'),
                'price' => $request->get('price')
            ));

        // save product without image first
            $product->save();

        // get last inserted product id and use it to identify image
            $imageName = $product->sku . '-' . $product->id . '.' . 
            $request->file('image')->getClientOriginalExtension();

        // save the new image
            $request->file('image')->move(
                base_path() . '/public/images/', $imageName
            );
            $product->image = $imageName;

        // update product with new image name
            $product->update();

        // save message in the flash session
            Session::flash('msg', 'success');

    return redirect('products_admin');  

	}
        
	       
        /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            Product::destroy($id);
            return redirect('products_admin');
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
           return view('products_admin.show')->with('product',$product);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            $menu_categories = Menu_category::lists('name', 'id');

            $product = Product::findOrFail($id);
            return view('products_admin.edit', compact('product', 'menu_categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        ob_start(); // not needed if output_buffering is on in php.ini
        ob_implicit_flush(); // implicitly calls flush() after every ob_flush()

            $product = Product::findOrFail($id);
            $this->validate($request,
                [
                    'dish' => 'required|min:5',
                    'sku' => 'required',
                    'menu_category_id' => 'required|Integer',
                    'price' => 'required'
                ]
                );

            
            $product->update($request->all());

            if($request->file('image')) {

            // get product id and sku and use it to identify image
                $imageName = $product->sku . '-' . $product->id . '.' . 
                $request->file('image')->getClientOriginalExtension();

            // save the new image
                $request->file('image')->move(
                    base_path() . '/public/images/', $imageName
                );
                $product->image = $imageName;

            // update product with new image name
                $product->update();
                //flush();
                ob_clean();
                ob_flush();
                //clearstatcache ();
                $products = Product::all();

            } // if updated image was submitted
            
            return redirect('products_admin');
        }

}
