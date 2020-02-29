<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get-top-rated-movies', 'ApiController@GetTopRatedMovies')->name('GetTopRatedMovies');
Route::get('/get-recent-movies', 'ApiController@GetRecentMovies')->name('GetRecentMovies');
Route::get('/get-genres', 'ApiController@GetGenres')->name('GetGenres');

