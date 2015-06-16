<?php
namespace App\Http\Controllers;
use App\Map;

class MapController extends Controller {

    public function  index(){
        $map = Map::all();
        return view('map.index')->with('map',$map);
    }

}
