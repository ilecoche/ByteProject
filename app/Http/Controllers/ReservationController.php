<?php 

namespace App\Http\Controllers;

use Request;
use App\ReservationClass;
use App\Tables;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller {
    
    public function index(){
        return view("reservation.index");
    }

    // --- Check for reservation availability --- //
    
    public function check(){

        if(Request::ajax()){
            
            $input = Request::all();  

            $date = $input['date'];
            $dateformat = (date('Y-m-d', strtotime($date)));
            $time = $input['time'];
            $capacity = $input['capacity'];

            $minTime = ReservationClass::getMinTime($time);
            $maxTime = ReservationClass::getMaxTime($time);
            
            $cap = ReservationClass::checkTables($dateformat, $minTime, $maxTime);
            
            $totalCap = ReservationClass::getTotalCap();
            
            if(($cap + $capacity) > $totalCap) {

                return view("reservation.full");
            }
            else {
                
                $list = ReservationClass::availableTables($dateformat, $minTime, $maxTime);

                return view("reservation.info")->with($input);
            }
        }
    }

    // --- Confirm reservation --- //
    
    public function reserve(){

        if(Request::ajax()){

            $input = Request::all();

            $date = $input['date'];
            $dateformat = (date('Y-m-d', strtotime($date)));
            $time = $input['time'];
            $capacity = $input['capacity'];
            $fname = $input['fname'];
            $lname = $input['lname'];
            $email = $input['email'];
            $phone = $input['phone'];

            /*
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
            */

            ReservationClass::makeReservation($dateformat, $time, $fname, $lname, $phone, $email, $capacity);
                
            return view('reservation.thanks')->with('data',$input);
         
        }
    }

    // --- Manage Tables --- //

    public function getTables(){

        $tables = Tables::all();

        date_default_timezone_set('America/Toronto');
        $today = date("Y-m-d");

        $reservationsToday = ReservationClass::getTodayReservations($today);

        $reservationTables = ReservationClass::getReservationTables($reservationsToday);
        
        //var_dump($reservationsToday);
        //var_dump($reservationTables);
        
        return view('reservation.tables')
            ->with('tables', $tables)
            ->with('rtables', $reservationTables);
    }

    public function store()
    {
        if(Request::ajax()){
        
            $table = new Tables;
            $table->table_num = Request::input('table_num');
            $table->capacity = Request::input('capacity');
            $table->save();

            $last_table = $table->id;

            $tables = Tables::whereId($last_table)->get();

            $input = Request::all();

            $table_num = $input['table_num'];
            $capacity = $input['capacity'];

            $data = array(
                'id' => $tables,
                'table_num' => $table_num,
                'capacity' => $capacity
            );

            return $data;
        }
    }  

    public function destroy()
    {
        if(Request::ajax()){

            $id = Request::input('id');
            
            $table = Tables::whereId($id)->delete();

        }
    }

    public function back()
    {
        //if(Request::ajax()){

            $input = Request::all();

            $date = $input['date'];
            $time = $input['time'];
            $capacity = $input['capacity'];

            return redirect('reservation')->withInput();

        //}
    }
}