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

Route::group(['middleware' => 'guest'], function () {
	Route::get('/',['as' => 'home','uses' => 'WhatsappController@index']);
	Route::get('/{phonenumber}/{text?}',['as'=>'direct','uses' => 'WhatsappController@send']);
	Route::post('/whatsapp',['as'=>'whatapps','uses' => 'WhatsappController@send_whatsapp']);
});
