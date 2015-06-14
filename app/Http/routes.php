<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/* Reservation */

Route::get('reservation', 'ReservationController@index');
Route::post('check', 'ReservationController@check');
Route::post('reserve', 'ReservationController@reserve');

/* Products Admin  */
Route::get('products_admin/nutrition/{ndbno}', 'ProductAdminController@nutrition' );
Route::post('products_admin/usdanumber', 'ProductAdminController@usdanumber' );
Route::resource('products_admin', 'ProductAdminController');


/* Cart */
//Route::post('cart/addredirect', 'CartController@addredirect');
Route::post('cart/add', 'CartController@add');
Route::get('cart', 'CartController@all');
Route::get('cart/empty', 'CartController@destroy');
Route::get('cart/remove/{id}', 'CartController@remove');
Route::get('cart/update/{id}/{qty}', 'CartController@update');

/* Products */
Route::resource('products', 'ProductController');

/* Orders */
Route::resource('orders', 'OrderController');

/* Payment Controller*/

Route::get('payment/{order_id}', 'PaymentController@index');
Route::post('payment/process', 'PaymentController@process');

/* Wait Time */

Route::get('wait', 'WaitController@waitIndex');
Route::post('wait', 'WaitController@waitPost');
Route::post('wait/seat', 'WaitController@waitSeat');
