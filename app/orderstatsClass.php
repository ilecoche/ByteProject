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

	public function bestSellingDays(){

	}


}