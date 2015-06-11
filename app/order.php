<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	protected $table = 'orders';
        
        protected $fillable = [
            'customer_name',
            'type',
            'tip'
            ];
        
        public $timestamps = false; // if timestamps columns are not present in the table

        
        // an order can have many order items
        public function order_items()
        {
            return $this->hasMany('App\Order_Item');
        }
}