<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model {
    
    protected $table = "menu_item";
    protected $fillable = [
        'dish',
        'description',
        'menu_category_id',
        'price',
        'sku',
        'image'
    ];
        

    public $timestamps = false; // if timestamps columns are not present in the table
    
    // a product is owned by the author
    public function menu_category()
    {
        return $this->belongsTo('App\Menu_Category');
    }
    
    

}
