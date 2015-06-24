<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\order;
use App\order_item;
use App\orderstatsClass;

use Illuminate\Support\Facades\DB;
use Request;

use Khill\Lavacharts\Lavacharts;

class OrderstatsController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function orderstats(){

		$orderstatsClass = new orderstatsClass();

		//best selling items

		$best_selling_items = $orderstatsClass->bestSellingItems();

		$bestSellingTable = \Lava::DataTable();

		$bestSellingTable->addStringColumn('Best Selling')
						 ->addNumberColumn('Qty');

						foreach ($best_selling_items as $item){

							$bestSellingTable->addRow(array($item->menu_item, $item->totalqty));
						}

		\Lava::BarChart('BestSelling')
						->setOptions(array(
							'datatable' => $bestSellingTable,
						));


		//best selling day

		$best_selling_days = $orderstatsClass->bestSellingDays();

		$bestSellingDaysTable = \Lava::DataTable();

		$bestSellingDaysTable->addDateColumn('Days')
		         			 ->addNumberColumn('Sales($)');

		         			$allDays = $best_selling_days['days'];

							foreach ($allDays as $day){

								$bestSellingDaysTable->addRow(array($day->date, $day->total));
							}

		$bestSellingDaysChart = \Lava::ComboChart('BestSellingDays')
								->setOptions(array(
									'datatable' => $bestSellingDaysTable,
									'titleTextStyle' => \Lava::TextStyle(array(
										'color' => 'rgb(123, 65, 89)',
										'fontSize' => 16
										)),
									'legend' => \Lava::Legend(array(
										'position' => 'in'
										)),
									'seriesType' => 'bars',
									'series' => array(
										2 => \Lava::Series(array(
											'type' => 'line'
											))
										)
									));

		//total tips

		$total_tips = $orderstatsClass->totalTips();

		$totalTipsTable = \Lava::DataTable();

		$totalTipsTable->addDateColumn('Days')
		         			 ->addNumberColumn('Tips($)');

		         			$allTips = $total_tips['tips'];

							foreach ($allTips as $tip){

								$totalTipsTable->addRow(array($tip->date, $tip->tiptotal));
							}

		$totalTipsChart = \Lava::ComboChart('TotalTips')
								->setOptions(array(
									'datatable' => $totalTipsTable,
									'titleTextStyle' => \Lava::TextStyle(array(
										'color' => 'rgb(123, 65, 89)',
										'fontSize' => 16
										)),
									'legend' => \Lava::Legend(array(
										'position' => 'in'
										)),
									'seriesType' => 'bars',
									'series' => array(
										2 => \Lava::Series(array(
											'type' => 'line'
											))
										)
									));

		//total revenue

		$total_revenue = $orderstatsClass->totalRevenue();

		return view("orderstats.orderstats")
						->with("tips", $total_tips)
						->with("total", $total_revenue);

	}

}