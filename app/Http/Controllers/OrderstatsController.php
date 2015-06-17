<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\order;
use App\order_item;
use App\orderstatsClass;

use Illuminate\Support\Facades\DB;
use Request;

class OrderstatsController extends Controller {

	public function orderstats(){

		$orderstatsClass = new orderstatsClass();

		//best selling items

		$best_selling_items = $orderstatsClass->bestSellingItems();

		//best selling days

		// $best_selling_days = $orderstatsClass->bestSellingDays();

		return view("orderstats.orderstats")
						->with("items", $best_selling_items);
	}

}