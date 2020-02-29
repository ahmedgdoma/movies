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

Route::get('/edit-config', 'ConfigurationsController@edit')->name('edit-config')->middleware('auth');
Route::patch('/update-config', 'ConfigurationsController@update')->name('update-config')->middleware('auth');
Route::get('/update-token', 'HomeController@updateToken')->name('updateToken')->middleware('auth');




Route::post('/api-login', 'ApiAuthController@ApiLogin')->name('ApiLogin');
Auth::routes();




Route::get('/', function (){
//    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

