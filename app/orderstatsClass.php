<?php 

namespace App;

use Illuminate\Support\Facades\DB;
use App\order;
use App\order_item;

class orderstatsClass {

	public function bestSellingItems(){
		$best_selling_items = DB::table('order_item')
					->select(DB::raw('id, order_id, menu_item, SUM(qty) as totalqty'))
		            ->groupBy('menu_item')
					->orderByRaw('SUM(qty) DESC')
                    ->get();

    	return $best_selling_items;
	}

	public function bestSellingDay(){

		$today = date("Y-m-d");
	    $todayTime = strtotime(date("Y-m-d"));

	    $weekAgoTime = $todayTime - 604800;
	    $weekAgoDate = date("Y-m-d", $weekAgoTime);

	    $best_selling_day = DB::table('orders')
					->select(DB::raw('id, order_no, date, SUM(total) as total'))
		            ->groupBy('date')
		            ->where(DB::raw('date BETWEEN ' . $today . ' and ' . $weekAgoDate))
					->orderByRaw('SUM(total) DESC')
                    ->get();

        var_dump($best_selling_day);

	}


}