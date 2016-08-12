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

Route::get('/', ['uses' => 'IndexController@getIndex']);

Route::post('/', ['uses' => 'IndexController@login']);

Route::get('/login', ['uses' => 'IndexController@getIndex']);

Route::get('/user/',
    ['uses' => 'UserController@userPage','middleware' => 'auth']);

Route::get('/sign-up/', ['uses' => 'SignUpController@signUpPage']);

Route::post('/sign-up/', ['uses' => 'SignUpController@signUp']);

Route::get('/logout/', ['uses' => 'LogoutController@logout']);

Route::get('/enable-tfa-via-sms/',
    ['uses' => 'EnableTfaViaSmsController@enableTfaViaSmsPage', 'middleware' => 'auth']);

Route::post('/enable-tfa-via-sms/',
    ['uses' => 'EnableTfaViaSmsController@enableTfaViaSms', 'middleware' => 'auth']);

Route::get('/enable-tfa-via-app/',
    ['uses' => 'EnableTfaViaAppController@enableTfaViaAppPage', 'middleware' => 'auth']);

Route::post('/enable-tfa-via-app/',
    ['uses' => 'EnableTfaViaAppController@enableTfaViaApp', 'middleware' => 'auth']);

Route::get('/verify-tfa/', ['uses' => 'VerifyTfaController@verifyTfaPage']);

Route::post('/verify-tfa/', ['uses' => 'VerifyTfaController@verifyTfa']);

Route::get('/auth-qr-code.png', ['uses' => 'AuthQrCodeController@qrcode']);

