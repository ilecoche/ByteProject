<?php 

namespace App;

use Illuminate\Support\Facades\DB;
use App\waittime;
use App\waitlist;

class waitClass {

	public function waitListCount(){

		$waitlistEntries = DB::table('waitlist')->count();

		//check number of entries in waittime table

		if($waitlistEntries == 0){

			//delete wait time table

			DB::table('waittime')->delete();

			$time = '0';

		}elseif($waitlistEntries == 1){

			//default value of 10

			$time = '5';

		}else{

			$waittimeEntries = DB::table('waittime')->count();

			if($waittimeEntries >= 2){

				//check for time 1 hour ago

				$hourTime = date("Y-m-d H:i:s");
				$time = strtotime($hourTime);
				$time = $time - (60 * 60);
				$hourTime = date("Y-m-d H:i:s", $time);

				//grab only entries in waittime table after $hourTime

				$rowGrab = DB::table('waittime')->where('entrytime', '>=', $hourTime)->get();

				$rowGrabCount = count($rowGrab);

				//calculate average

				$sum = 0;

				foreach($rowGrab as $key => $value)
				{
					$sum = $sum + $value->waittime;
				}

				$totalSum = $sum / $rowGrabCount;

				$time = floor($totalSum);

			}else{

				//default time of 15
				$time = '10';
			}

		}

		return $time;

	}

}