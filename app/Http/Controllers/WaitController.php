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
		
			// Request::input('id');
			//insert into waittime

			// $waittime = new waittime();
			// $currentdt = date('Y-m-d H:i:s');


			// $waitClass = new waitClass();

			// $count = $waitClass->waitTimeCount();

			// return $count;

		return Request::input('id');

		

	}
            

}