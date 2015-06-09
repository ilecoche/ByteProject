<?php 

namespace App;

use Illuminate\Support\Facades\DB;
use App\waittime;
use App\waitlist;

class waitClass {

	public function waitListCount(){
		
	}

	public function waitTimeCount(){

		$waittime = DB::table('waittime')->count();

		//check number of entries in waittime table

		if($waittime >= 2){

			//check for time 1 hour ago

			$date = date("Y-m-d H:i:s");
			$time = strtotime($date);
			$time = $time - (60 * 60);
			$date = date("Y-m-d H:i:s", $time);

			//grab only entries in waittime table after $date

			$rowGrab = DB::table('waittime')->count();

			$time = $date;

		}elseif($waittime == 1){

			//default value of 10

			$time = '10 Minutes';

		}else{

			//default value of 0

			$time = '0';
		}

		return $time;

	}

}