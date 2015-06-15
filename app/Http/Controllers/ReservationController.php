<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReservationClass;
use Session;

class ReservationController extends Controller {
    
    public function index(){
        return view("reservation.index");
    }
    
    public function check(Request $request){
        

        $input = $request->all();       
        

        
        if(Session::has('time') !== null){$time = Session::get('time');}
        else { $time = $input['time'];}
        if(Session::has('capacity') !== null){$capacity = Session::get('capacity');}
        else {$capacity = $input['capacity'];}
        if(Session::get('date') !== null) {$date = Session::get('date');}
        else {$date = $input['date'];}

        Session::flash('date', $date);
        Session::flash('time', $time);
        Session::flash('capacity', $capacity);

        $minTime = ReservationClass::getMinTime($time);
        $maxTime = ReservationClass::getMaxTime($time);
        
        $cap = ReservationClass::checkTables($date, $minTime, $maxTime);
        
        $totalCap = ReservationClass::getTotalCap();
        
        if(($cap + $capacity) > $totalCap) {
            return view("reservation.full");
        }
        else {
            $list = ReservationClass::availableTables($date, $minTime, $maxTime);
            return view("reservation.info")
                    ->with('date', $date)
                    ->with('time', $time)
                    ->with("capacity", $capacity)
                    ->with('list', $list);
        }
    }
    
    public function reserve(Request $request){

        $this->validate($request, 
        [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
        
        $input = $request->all();
        
        $date = $input['date'];
        $time = $input['time'];
        $capacity = $input['capacity'];
        $fname = $input['fname'];
        $lname = $input['lname'];
        $email = $input['email'];
        $phone = $input['phone'];
        
        ReservationClass::makeReservation($date, $time, $fname, $lname, $phone, $email, $capacity);
        
        return view("reservation.thanks")
                ->with('date', $date)
                ->with('time', $time)
                ->with('capacity', $capacity)
                ->with('fname', $fname)
                ->with('lname', $lname)
                ->with('email', $email)
                ->with('phone', $phone);
    }
    
}