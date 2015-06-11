<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class waittime extends Model {

	protected $table = 'waittime';
    public $timestamps = false;   
    protected $fillable = ['id','waittime', 'entrytime'];
        
}