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
Route::middleware(['auth'])->group(function () {
    Route::get('/edit-config', 'ConfigurationsController@edit')->name('edit-config');
    Route::patch('/update-config', 'ConfigurationsController@update')->name('update-config');
    Route::post('/update-token', 'HomeController@updateToken')->name('updateToken');
});





Route::post('/api-login', 'ApiAuthController@ApiLogin')->name('ApiLogin');
Auth::routes();




Route::get('/', function (){
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

