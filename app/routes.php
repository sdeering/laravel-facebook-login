<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/*

  Public Routes

*/

Route::get('/', 'HomeController@showHome');
Route::get('login', 'HomeController@showLogin');

/*

  AUTH Routes

*/

Route::get('login/fb', 'AuthController@doFacebookAuth');
Route::get('login/fb/callback', 'AuthController@doFacebookLogin');
Route::get('logout', 'AuthController@doLogout');

/*

  USER Routes

*/

Route::group(array('before' => 'auth'), function() {

  //Resource API
  Route::resource('users', 'UserController');

});
