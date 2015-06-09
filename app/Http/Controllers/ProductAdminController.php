<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Product;
use App\Menu_category;
use App\Http\Requests\CreateProductRequest;
use Session;

class ProductAdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return view('products_admin.create');
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
        
	public function store2(Request $request)
	{
            $this->validate($request,
                [
                    'dish' => 'required|min:5',
                    'sku' => 'required',
                    'menu_category_id' => 'required|Integer',
                    'price' => 'required'
                ]
                );
            $input = $request->all();
            Product::create($input);
//            $product = new Product;
//            
//            $product->title = $input['title'];
//            $product->description = $input['description'];
//            $product->author = $input['author'];
//            $product->price = $input['price'];
//            
//            $product->save();
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
