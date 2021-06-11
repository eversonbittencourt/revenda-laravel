<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'UsersController@login');

Route::middleware('auth:api')->group(function () {

    Route::post('users', 'UsersController@store');

    Route::put('users/{user}', 'UsersController@update');

    Route::get('users/{user}', 'UsersController@show');

    Route::delete('users/{user}', 'UsersController@destroy');

    Route::get('users', 'UsersController@index');

    Route::post('addresses/consult/post-code', 'AddressesController@consultByPostCode');
    
    Route::post('addresses/consult/route', 'AddressesController@consultByRoute');

    Route::post('addresses', 'AddressesController@store');

    Route::put('addresses/{address}', 'AddressesController@update');

    Route::get('addresses/{address}', 'AddressesController@show');

    Route::delete('addresses/{address}', 'AddressesController@destroy');

    Route::get('addresses', 'AddressesController@index');

});