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

Route::get('/', ['as' => 'home', function () {
    return view('home');
}]);

Route::get('/home', function() {
    return view('home');
});

Route::get('/contact', ['as' => 'contact', function() {
    return view('contact');
}]);

Route::post('/contact', ['as' => 'contact_send', 'uses' => 'ContactController@store']);

Route::get('/order', ['as' => 'order', function() {
    return view('order');
}]);

Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['as' => 'attempt_login', 'uses' => 'AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

// Order process
Route::get('/order', ['as' => 'order', 'uses' => 'OrderController@index']);
Route::post('/order', ['as' => 'add_to_order', 'uses' => 'OrderController@add_to_order']);
Route::get('/current_order', ['as' => 'current_order', 'uses' => 'OrderController@current_order']);
Route::put('/order', ['as' => 'update_order', 'uses' => 'OrderController@update_order']);
Route::post('/send_order', ['as' => 'send_order', 'uses' => 'OrderController@send_order']);



Route::get('/about', ['as' => 'about', function() {
    return view('about');
}]);

Route::get('/opening', ['as' => 'opening', function () {
    return view('opening');
}]);
