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


class ProductAdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    const NDBKEY = '7nEAe6LI7yfT7R4IxPjZSafCpqNUZGz2FU27MugY';
 
    /*
    define('APIID', '64b969ff');
    define('APIKEY', 'f60dabd6813bc369c33a870880947859');
    */

    public function getNestedArray(){
              $menu_categories = Menu_category::all();
              $products = array();
              foreach($menu_categories as $mc){
                  $productByCategory = Product::where('menu_category_id', '=', $mc['id'])->get();
                  $products[$mc['name']] = $productByCategory;
              }
              return $products;
          }

	public function index()
	{
            //dd(Session::get('msg'));
            //$message = $msg;
            //$products = Product::all();
            $products = $this->getNestedArray();
            $message = Session::get('msg');
            //dd($products);
            return view('products_admin.index', compact('products', 'message'));
	}

    public function nutrition()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://api.nal.usda.gov/ndb/']);
        // Request to http://api.nal.usda.gov/ndb/reports/?ndbno=01009&type=f&format=json&api_key=7nEAe6LI7yfT7R4IxPjZSafCpqNUZGz2FU27MugY
        $response = $client->get('http://api.nal.usda.gov/ndb/reports', [
            'query' => [
                'ndbno' => '21250',
                'type' => 'f',
                'format' => 'json',
                'api_key' => self::NDBKEY
            ]
        ]);
        $body = json_decode($response->getBody());
        echo $body->report->food->name. '</br>';
        $nutrients = array_slice($body->report->food->nutrients , 0, 9);
        //var_dump($nutrients);
        
        foreach ($nutrients as $nutrient) {
            echo $nutrient->name . ': Per 100g ' . $nutrient->value . $nutrient->unit . '; ';
            echo 'Per ' . $nutrient->measures[0]->label . ': '. $nutrient->measures[0]->value . $nutrient->unit . '<hr/>';
        }
        
        //return view('products_admin.nutrition')->with('response', $response);
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
            //return "validate";
            
            //Product::create($request->all());
            //return redirect('products_admin');
            
            
             $product = new Product(array(
                'dish' => $request->get('dish'),
                'sku'  => $request->get('sku'),
                'menu_category_id' => $request->get('menu_category_id'),
                'price' => $request->get('price')
            ));

            $product->save();

            $imageName = $product->sku . '-' . $product->id . '.' . 
            $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                base_path() . '/public/images/', $imageName
            );
            $product->image = $imageName;
            $product->update();
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
            //return $product;
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
            $product = Product::findOrFail($id);

            return view('products_admin.edit', compact('product'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
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
            
            return redirect('products_admin');
        }

}
