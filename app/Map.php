<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Map extends Model {
    protected $table ="restaurant_settings";
    public $timestamps = false;
    
    protected $fillable = [
        'address',
        'business_hours',
        'business_name',
        'business_number',
        'city',
        'email',
        'hst_reg_number',
        'number_of_tables',
        'owner_name',
        'phone',
        'postal_code',
        'website'
    ];
}
