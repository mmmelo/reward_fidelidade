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


//Route::get( 'users', 'Api\\UserController@index');
//Route::resource( 'users', 'Api\\UserController');
Route::post( 'login', 'Api\\LoginController@auth');
Route::post( 'logout', 'Api\\LoginController@logout');

Route::prefix('v1')->namespace('api')->group( function (){
    Route::group(['middleware' => ['jwt']], function (){
        Route::resource( 'users', 'UserController');
    });

});