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
        return view("wait.wait")
                ->with("entries", $waitlist);
	}

	public function waitPost()
	{
		if(Request::ajax()){

            $waitlist = new waitlist();
            $dt = date('Y-m-d H:i:s');

            $waitlist->name = Request::input('name');
            $waitlist->partynumber = Request::input('partynumber');
            $waitlist->email = Request::input('email');
            $waitlist->number = Request::input('number');
            $waitlist->datetime = $dt;

            $waitlist->save();

            $last_id = $waitlist->id;

            $waitlist_row = waitlist::whereId($last_id)->get();

            return $waitlist_row;
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

		//delete row from waitlist table

		$waitlistRowDelete = waitlist::whereId($id)->delete();

		//Do average wait calculation

		$waitClass = new waitClass();

		$avgCalc = $waitClass->waitListCount();

		// return $count;

		return $avgCalc;

		

	}
            

}