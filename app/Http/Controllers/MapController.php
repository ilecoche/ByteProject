<?php
namespace App\Http\Controllers;
use App\Map;
use App\WaitClass; 

class MapController extends Controller {

    public function  index(){
        $map = Map::all();
        $waitClassCalc = new waitClass();
        $avgCalc = $waitClassCalc->waitListCount();
        return view('map.index')->with('map',$map)->with('avg',$avgCalc); 
        
        
        
    }
    
    
}


