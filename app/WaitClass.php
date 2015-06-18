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

				if($rowGrabCount === 0){

					//delete both tables and start over since this would never happen in a restaurant - a count of 0 is returned if there is no action in the application over an hour - this stops the sum from being subtracted by 0.

					//time will be zero since this would mean that no action has taken place in the application and therefore no one is using it

					DB::table('waitlist')->delete();
					DB::table('waittime')->delete();

					$time = '0';

				}else{

					//calculate average

					$sum = 0;

					foreach($rowGrab as $key => $value)
					{
						$sum = $sum + $value->waittime;
					}

					$totalSum = $sum / $rowGrabCount;

					$time = floor($totalSum);

				}

			}else{

				//default time of 15
				$time = '10';
			}

		}

		return $time;
	}

	public function sendEmail($email, $name){
		
		$to = $email;
		
		$final_subject = 
			'Your Table Is Ready!';
		
		$final_message = "Hello " . $name . ". Your table is now ready! Please return within 5 minutes to keep your assigned table.";
		
		$final_headers = "From: seating@restaurant.com" .
						 "Reply-To: seating@restaurant.com" .
						 "X-Mailer: PHP/" . phpversion();
		
		mail($to, $final_subject, $final_message, $final_headers);

	}
}