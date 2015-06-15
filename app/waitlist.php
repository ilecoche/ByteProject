<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class waitlist extends Model {

	protected $table = 'waitlist';
    public $timestamps = false;   
    protected $fillable = ['id','name', 'email', 'number', 'partynumber', 'datetime'];
        
}