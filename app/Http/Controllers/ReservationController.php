<?php 

namespace App\Http\Controllers;

use Request;
use App\ReservationClass;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller {
    
    public function index(){
        return view("reservation.index");
    }
    
    public function check(){

        if(Request::ajax()){
            
            $input = Request::all();  

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
                //return view("reservation.full");
                echo 'The reservation time is full';
            }
            else {
                
                $list = ReservationClass::availableTables($date, $minTime, $maxTime);

                return view("reservation.info")->with($input);
            }
        }
    }
    
    public function reserve(){

        if(Request::ajax()){

            Session::reflash();

            $input = Request::all();

            $date = $input['date'];
            $dateformat = date('Y-m-d', strtotime($date));
            $time = $input['time'];
            $capacity = $input['capacity'];
            $fname = $input['fname'];
            $lname = $input['lname'];
            $email = $input['email'];
            $phone = $input['phone'];

            //$this->validate($input, 
            $validator = Validator::make(Input::all(),
            [
                'fname' => 'required|min:2',
                'lname' => 'required|min:2',
                'email' => 'required|email',
                'phone' => 'required|regex:/^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/',
            ],
            [
                'fname.required' => 'Please enter your first name',
                'fname.min' => 'Invalid first name',
                'lname.required' => 'Please enter your last name',
                'lname.min' => 'Invalid last name',
                'email.required' => 'Please enter your email',
                'email' => 'Invalid email',
                'phone.required' => 'Please enter your phone number',
                'phone.regex' => 'Invalid phone number'
                
            ]);

            if ($validator->fails()){
              //validation fails to send response with validation errors
              // print $validator object to see each validation errors and display validation errors in your views
             //return Redirect::to('signup')->withErrors($validator);
                echo 'that sux';
            }

            ReservationClass::makeReservation($dateformat, $time, $fname, $lname, $phone, $email, $capacity);
                
            return view('reservation.thanks')->with('data',$input);
         
        }
    }

    public function postReserve(Request $request){

        Session::reflash();

        $this->validate($request, 
        [
            'fname' => 'required|min:2',
            'lname' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/',
        ],
        [
            'fname.required' => 'Please enter your first name',
            'fname.min' => 'Invalid first name',
            'lname.required' => 'Please enter your last name',
            'lname.min' => 'Invalid last name',
            'email.required' => 'Please enter your email',
            'email' => 'Invalid email',
            'phone.required' => 'Please enter your phone number',
            'phone.regex' => 'Invalid phone number'
            
        ]);
        
        $input = Request::all(); 
        
        $date = $input['date'];
        $dateformat = date('Y-m-d', strtotime($date));
        $time = $input['time'];
        $capacity = $input['capacity'];
        $fname = $input['fname'];
        $lname = $input['lname'];
        $email = $input['email'];
        $phone = $input['phone'];

        // $date = $input['date'];
        // $dateformat = date('Y-m-d', strtotime($date));
        // $time = $input['time'];
        // $capacity = $input['capacity'];
        // $fname = $input['fname'];
        // $lname = $input['lname'];
        // $email = $input['email'];
        // $phone = $input['phone'];
        
        ReservationClass::makeReservation($dateformat, $time, $fname, $lname, $phone, $email, $capacity);

    }
}