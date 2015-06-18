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

		$today = date("Y-m-d");
	    $todayTime = strtotime(date("Y-m-d"));

	    $weekAgoTime = $todayTime - 518400;
	    $weekAgoDate = date("Y-m-d", $weekAgoTime);

	    $best_selling_days = DB::table('orders')
					->select(DB::raw('id, order_no, date, SUM(total) as total'))
		            ->groupBy('date')
		            ->where('date', '<=', $today)
					->where('date', '>=', $weekAgoDate)
					->orderByRaw('SUM(total) DESC')
                    ->get();

        $data = array(
	    			'week_ago_day' => date('l', $weekAgoTime),
	    			'week_ago' => $weekAgoDate,
	    			'days' => $best_selling_days
					);

        return $data;

	}

	public function totalTips(){

		$today = date("Y-m-d");
	    $todayTime = strtotime(date("Y-m-d"));
	    $todayInWeek = date('w') + 1;
	    $endOfLastWeek = $todayTime - (86400 * $todayInWeek);
	    $endOfLastWeekDate = date("Y-m-d", $endOfLastWeek);
	    $endOfLastWeekDateTime = strtotime($endOfLastWeekDate);
	    $beginningOfLastWeekDateTime = $endOfLastWeekDateTime - 518400;
	    $beginningOfLastWeekDate = date("Y-m-d", $beginningOfLastWeekDateTime);

	    $total_tips = DB::table('orders')
					->select(DB::raw('id, order_no, date, SUM(tip) as tiptotal'))
		            ->groupBy('date')
		            ->where('date', '<=', $endOfLastWeekDate)
					->where('date', '>=', $beginningOfLastWeekDate)
					->orderByRaw('SUM(tip) DESC')
                    ->get();

        $totalValue = DB::table('orders')
					->select(DB::raw('SUM(tip) as tiptotalfull'))
		            ->where('date', '<=', $endOfLastWeekDate)
					->where('date', '>=', $beginningOfLastWeekDate)
                    ->get();

        $data = array(
	    			'week_end' => $endOfLastWeekDate,
	    			'week_start' => $beginningOfLastWeekDate,
	    			'tips' => $total_tips,
	    			'totalTip' => $totalValue
					);

        return $data;
	}

	public function totalRevenue(){

		$today = date("Y-m-d");
	    $todayTime = strtotime(date("Y-m-d"));
	    $todayInWeek = date('w') + 1;
	    $endOfLastWeek = $todayTime - (86400 * $todayInWeek);
	    $endOfLastWeekDate = date("Y-m-d", $endOfLastWeek);
	    $endOfLastWeekDateTime = strtotime($endOfLastWeekDate);
	    $beginningOfLastWeekDateTime = $endOfLastWeekDateTime - 518400;
	    $beginningOfLastWeekDate = date("Y-m-d", $beginningOfLastWeekDateTime);

	    $total_rev = DB::table('orders')
					->select(DB::raw('SUM(total) as totalfull'))
		            ->where('date', '<=', $endOfLastWeekDate)
					->where('date', '>=', $beginningOfLastWeekDate)
                    ->get();

        return $total_rev;
	}


}