<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

	protected $table = 'waitlist';
    public $timestamps = false;   
    protected $fillable = [
    	'id',
    	'date', 
    	'time', 
    	'first_name', 
    	'last_name', 
    	'phone',
    	'email',
    	'capacity'
    ];
        
}