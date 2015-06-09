<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model {

    protected $table = 'order_item';
    
    public $timestamps = false; // if timestamps columns are not present in the table

    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    
        
}
