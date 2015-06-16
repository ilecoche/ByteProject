<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class testimonial extends Model {
	protected $table = 'reviews';

    protected $fillable = [
        'author',
        'body',
        'rating'
    ];

}
