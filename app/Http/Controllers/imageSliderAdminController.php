<?php

namespace App\Http\Controllers;
use App\Map;
use Illuminate\Http\Request;
class imageSliderAdminController extends Controller {

//        public function __construct()
//    {
//        $this->middleware('auth');
//    }
    public function create(){
        return view('ImagesAdmin.index');
    }
    public function store(Request $request){
        
        // get last inserted product id and use it to identify image
            
            $request->file('image')->getClientOriginalExtension();

        // save the new image
            $request->file('image')->move(
                base_path() . '/public/images/slider'
            );
            $request->save();
    }
    
}