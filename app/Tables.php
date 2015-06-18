<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model {

	protected $table = "tables";
	public $timestamps = false;
	protected $fillable = [
		'id',
		'table_num',
		'capacity'
	];

}