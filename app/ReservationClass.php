<?php

namespace App;

use Illuminate\Support\Facades\DB;

class ReservationClass {
    
    public static function checkTables($date, $timeMin, $timeMax){
        $reservedCap = DB::table('reservation')
                            ->join('tables_reservations', 'reservation.id', '=', 'tables_reservations.reservation_id')
                            ->join('tables', 'tables_reservations.table_id', '=', 'tables.id')
                            ->where('reservation.date', '=', $date)
                            ->where('reservation.time', '>=', $timeMin)
                            ->where('reservation.time', '<=', $timeMax)
                            ->sum('tables.capacity');
        
        return $reservedCap;
    }
    
    public static function makeReservation($date, $time, $fname, $lname, $phone, $email, $capacity){
        $id = DB::table('reservation')->insertGetId([
                'date' => $date, 
                'time' => $time, 
                'first_name' => $fname,
                'last_name' => $lname,
                'phone' => $phone,
                'email' => $email,
                //'requests' => $request,
                'capacity' => $capacity
        ]);
        
        $minTime = self::getMinTime($time);
        $maxTime = self::getMaxTime($time);
        
        $tableList = self::availableTables($date, $minTime, $maxTime);
        
        self::assignTables($id, $capacity, $tableList);
    }
    
    public static function assignTables($id, $capacity, $tableList){
        $tables2 = array();
        $tables4 = array();
        foreach($tableList as $table){
            if($table->capacity == 2){
                $tables2[] = $table;
            }
            else{
                $tables4[] = $table;
            }
        }
        
        while($capacity > 4){
            if(count($tables4) > 0){
                $table = array_pop($tables4);
                DB::table('tables_reservations')->insert([
                  'reservation_id' => $id,
                  'table_id' => $table->id
                ]);
                $capacity = $capacity - 4;
            }
            else{
                $table1 = array_popC($tables2);
                $table1 = array_popC($tables2);
                DB::table('tables_reservations')->insert([
                  'reservation_id' => $id,
                  'table_id' => $table1->id
                ]);
                DB::table('tables_reservations')->insert([
                  'reservation_id' => $id,
                  'table_id' => $table2->id
                ]);
                $capacity = $capacity - 4;
            }
        }
        
        if($capacity >= 3){
            if(count($tables4) > 0){
                $table = array_pop($tables4);
                DB::table('tables_reservations')->insert([
                  'reservation_id' => $id,
                  'table_id' => $table->id
                ]);
            }
            else{
                $table1 = array_pop($tables2);
                $table1 = array_pop($tables2);
                DB::table('tables_reservations')->insert([
                  'reservation_id' => $id,
                  'table_id' => $table1->id
                ]);
                DB::table('tables_reservations')->insert([
                  'reservation_id' => $id,
                  'table_id' => $table2->id
                ]);
            }
        }
        else{
            $table = array_pop($tables2);
            DB::table('tables_reservations')->insert([
              'reservation_id' => $id,
              'table_id' => $table->id
            ]);
        }
        
    }
    
    public static function availableTables($date, $minTime, $maxTime){
        $reservedList = DB::table('reservation')
                            ->join('tables_reservations', 'reservation.id', '=', 'tables_reservations.reservation_id')
                            ->join('tables', 'tables_reservations.table_id', '=', 'tables.id')
                            ->where('reservation.date', '=', $date)
                            ->where('reservation.time', '>=', $minTime)
                            ->where('reservation.time', '<=', $maxTime)
                            ->select('tables.id')
                            ->get();
        $resList = array();
        foreach($reservedList as $row){
            $resList[] = $row->id;
        }
        
        $tableList = DB::table('tables')->whereNotIn('id', $resList)->get();
        
        return $tableList;
    }
    
    public static function getMinTime($time){
        if($time < "1400") {
            return "1200";
        }
        else{
            return $time - 200;
        }
    }
    
    public static function getMaxTime($time){
        if($time > "1830") {
            return "2030";
        }
        else{
            return $time + 200;
        }
    }
    
    public static function getTotalCap(){
        return DB::table('tables')->sum('capacity');
    }

    public static function getTodayReservations($today){

        $today_reservations = DB::table('reservation')
                ->select('reservation.id', 'date', 'time', 'first_name', 'last_name', 'phone', 'email', 'reservation.capacity', 'table_id', 'table_num')
                ->join('tables_reservations', 'tables_reservations.reservation_id', '=', 'reservation.id')
                ->join('tables', 'tables.id', '=', 'tables_reservations.table_id')
                ->where('date', '=', $today)
                ->get();

        return $today_reservations;
    }
    
}