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

Route::get('/', 'IndexController@getIndex');

Route::post('/', 'IndexController@login');

Route::get('/user/', 'UserController@userPage');

Route::get('/sign-up/', 'SignUpController@signUpPage');

Route::post('/sign-up/', 'SignUpController@signUp');
