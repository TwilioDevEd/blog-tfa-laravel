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

Route::get('/login', 'IndexController@getIndex');

Route::get('/user/', ['middleware' => 'auth', 'uses' => 'UserController@userPage']);

Route::get('/sign-up/', 'SignUpController@signUpPage');

Route::post('/sign-up/', 'SignUpController@signUp');

Route::get('/logout/', 'LogoutController@logout');

Route::get('/enable-tfa-via-sms/', 'EnableTfaViaSmsController@enableTfaViaSmsPage');

Route::post('/enable-tfa-via-sms/', 'EnableTfaViaSmsController@enableTfaViaSms');

Route::get('/enable-tfa-via-app/', 'EnableTfaViaAppController@enableTfaViaAppPage');

Route::post('/enable-tfa-via-app/', 'EnableTfaViaAppController@enableTfaViaApp');
