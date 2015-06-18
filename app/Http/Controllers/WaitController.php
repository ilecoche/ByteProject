<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\waittime;
use App\waitlist;
use App\WaitClass;

use Illuminate\Support\Facades\DB;
use Request;

class WaitController extends Controller {

	public function waitIndex()
	{
		$waitlist = waitlist::all();
		$waitClass = new waitClass();
		$avgCalc = $waitClass->waitListCount();
        return view("wait.wait")
                ->with("entries", $waitlist)
                ->with("average", $avgCalc);
	}

	public function waitPost()
	{
		if(Request::ajax()){

			$namePat = "/^[a-z ,.'-]+$/i";
			$partyPat = "/^[0-9]{1,2}$/";
			$emailPat = "/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/";
			$pnumberPat = "/^\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*$/";

            $waitlist = new waitlist();
            $dt = date('Y-m-d H:i:s');

            //server side validation

            $name = Request::input('name');
            $party = Request::input('partynumber');
            $email = Request::input('email');
            $number = Request::input('number');

            if(!preg_match($namePat, $name) || !preg_match($partyPat, $party) || !preg_match($emailPat, $email) || !preg_match($pnumberPat, $number)){
				return false;	
			}else{

	            $waitlist->name = $name;
	            $waitlist->partynumber = $party;
	            $waitlist->email = $email;
	            $waitlist->number = $number;
	            $waitlist->datetime = $dt;

	            $waitlist->save();

	            $last_id = $waitlist->id;

	            $waitlist_row = waitlist::whereId($last_id)->get();

	            $waitClass = new waitClass();
				$avgCalc = $waitClass->waitListCount();

				$data = array(
	    			'data' => $waitlist_row,
	    			'average' => $avgCalc
					);

	            return $data;
	        }
        }
	}

	public function waitSeat()
	{
		//Calculate wait and insert into waittime table

		$id = Request::input('id');
		$dt = date('Y-m-d H:i:s');

		//get customer wait time in seconds

		$customerInfo = waitlist::whereId($id)->get();
		$customerEntry = strtotime($customerInfo[0]->datetime);
		$customerExit = strtotime(date("Y-m-d H:i:s"));
		$remainingTime = $customerExit - $customerEntry;

		//convert seconds to minutes

		$customerWait = floor($remainingTime / 60);

		//insert calculation into waittime table

		$waittime = new waittime();
		$waittime->waittime = $customerWait;
		$waittime->entrytime = $dt;
		$waittime->save();

		//send email to customer

		$waitClassEmail = new waitClass();

		$customerEmail = $customerInfo[0]->email;
		$customerName = $customerInfo[0]->name;

		$waitClassEmail->sendEmail($customerEmail, $customerName);

		//delete row from waitlist table

		$waitlistRowDelete = waitlist::whereId($id)->delete();

		//Do average wait calculation

		$waitClassCalc = new waitClass();

		$avgCalc = $waitClassCalc->waitListCount();

		// return $count;

		return $avgCalc;
	}
}