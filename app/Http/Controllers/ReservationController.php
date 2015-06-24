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

    // --- Confirm reservation and insert into database --- //
    
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

            ReservationClass::makeReservation($dateformat, $time, $fname, $lname, $phone, $email, $capacity);

            //ReservationClass::sendEmail($email, $fname);
                
            return view('reservation.thanks')->with('data',$input);
         
        }
    }

    // --- Go back to first reservation step --- //

    public function back()
    {
        $input = Request::all();

        $date = $input['date'];
        $time = $input['time'];
        $capacity = $input['capacity'];

        return redirect('reservation')->withInput();
    }

    // --- Get restaurant tables for CMS --- //

    public function getTables(){

        $tables = Tables::all();
        
        return view('reservation.tables')
            ->with('tables', $tables);
    }

    // --- Insert restaurant tables for CMS --- //

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

    // --- Delete restaurant tables for CMS --- //

    public function destroy()
    {
        if(Request::ajax()){

            $id = Request::input('id');
            
            $table = Tables::whereId($id)->delete();

        }
    }

    // --- Cancel and delete restaurant tables for CMS --- //

    public function cancelReservation()
    {
        if(Request::ajax()){

            $id = Request::input('id');
            
            ReservationClass::deleteReservation($id);
            ReservationClass::deleteTablesReservations($id);

        }
    }

    // --- Get today's reservations --- //

    public function todayReservations()
    {
        date_default_timezone_set('America/Toronto');
        $today = date("Y-m-d");

        $reservationsToday = ReservationClass::getTodayReservations($today);

        $reservationTables = ReservationClass::getReservationTables($reservationsToday);
        
        return view('reservation.reservation_partial')
            ->with('rtables', $reservationTables);
    }
}