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

Route::get('list-movie', 'Api\ListMovieController@list');
Route::get('list-movie-pagination/{page}', 'Api\ListMovieController@listpagination');
Route::get('details/{id}', 'Api\ListMovieController@details');
Route::get('genres', 'Api\ListMovieController@genres');
Route::post('search-name', 'Api\ListMovieController@searchname');
Route::get('search-name-pagination/{title}/{page}', 'Api\ListMovieController@searchnamepagination');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
