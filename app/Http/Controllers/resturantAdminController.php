<?php
namespace App\Http\Controllers;
use App\Map;
use Illuminate\Http\Request;
class resturantAdminController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function  index(){
        $map = Map::all();
        return view('resturant_settings_admin.index')->with('map',$map);
    }
    
    public function show()
    {
        $map = Map::first();
        
        return view('resturant_settings_admin.edit')->with('map',$map);
        
    }
   
    public function update(Request $request)
	{
        
            $resturant = Map::findOrFail(1);
            $this->validate($request,
                [
                    'address' => 'required',
                    'business_hours' => 'required',
                    'business_name' => 'required',
                    'business_number' => 'required',
                    'phone' => 'required',
                    'category' => 'required',
                    'owner_name' => 'required',
                    'email' => 'required',
                    'city' => 'required',
                    'website' => 'required',
                    'postal_code' => 'required',
                    'price' => 'required',
                    'number_of_tables' => 'required',
                    'business_number' => 'required',
                    'hst_reg_number' => 'required'
                ]
                );
            
            $resturant->update($request->all());
            return redirect('restaurantAdmin');
    }
    
    

}
