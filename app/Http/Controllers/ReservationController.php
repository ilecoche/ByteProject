<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReservationClass;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller {
    
    public function index(){
        return view("reservation.index");
    }
    
    public function check(Request $request){

        $input = $request->all();       

        if(!isset($input['date'])){
            $date = Session::get('date');
        }else{
            $date = $input['date'];
        }

        if(!isset($input['time'])){
            $time = Session::get('time');
        }else{
            $time = $input['time'];
        }

        if(!isset($input['capacity'])){
            $capacity = Session::get('capacity');
        }else{
            $capacity = $input['capacity'];
        }

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
       
            return view("reservation.info", compact('date', 'time', 'capacity', 'list'));
        }
    }
    
    public function reserve(Request $request){

        $input = $request->all();
        
        $date = $input['date'];
        $time = $input['time'];
        $capacity = $input['capacity'];

        if(Input::get('reserve'))
        {
            $this->postReserve($request);
        }
        else if(Input::get('back'))
        {
           return Redirect('reservation')->withInput();
        }
    }

    public function postReserve(Request $request){

        Session::reflash();

        $this->validate($request, 
        [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
        
        $input = $request->all();
        
        $date = $input['date'];
        $date = date('Y-m-d', strtotime($date));
        $time = $input['time'];
        $capacity = $input['capacity'];
        $fname = $input['fname'];
        $lname = $input['lname'];
        $email = $input['email'];
        $phone = $input['phone'];
        
        ReservationClass::makeReservation($date, $time, $fname, $lname, $phone, $email, $capacity);
        
        echo 'thanks';

        return Redirect('thanks');
                // ->with('date', $date)
                // ->with('time', $time)
                // ->with('capacity', $capacity)
                // ->with('fname', $fname)
                // ->with('lname', $lname)
                // ->with('email', $email)
                // ->with('phone', $phone);

                 var_dump($date);
    }
    
}