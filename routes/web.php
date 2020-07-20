<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
	'uses' =>'FrontendsController@index',
	'as' => 'index'
]);

Route::get('products/single/{id}', [
	'uses' => 'FrontendsController@singleProduct',
	'as' => 'products.single'
]);

Route::post('/cart/add', [
	'uses' => 'ShoppingController@add_to_cart',
	'as' => 'cart.add'
]);

Route::get('/cart', [
	'uses' => 'ShoppingController@cart',
	'as' => 'cart'
]);

Route::get('/cart/delete/{id}', [
	'uses' => 'ShoppingController@cart_delete',
	'as' => 'cart.delete'
]);

Route::get('/cart/decr/{id}/{qty}', [
	'uses' => 'ShoppingController@decr',
	'as' => 'cart.decr'
]);

Route::get('/cart/incr/{id}/{qty}', [
	'uses' => 'ShoppingController@incr',
	'as' => 'cart.incr'
]);

Route::get('/cart/rapid/add/{id}', [
	'uses' => 'ShoppingController@rapid_add',
	'as' => 'rapid.add'
]);

Route::get('/cart/checkout', [
	'uses' => 'CheckoutController@index',
	'as' => 'cart.checkout'
]);

Route::post('/cart/checkout', [
	'uses' => 'CheckoutController@pay',
	'as' => 'cart.checkout'
]);


Auth::routes();


Route::group(['middleware' => 'auth'], function(){

	Route::get('/home', 'HomeController@index');
	
	Route::resource('products', 'ProductsController');
});