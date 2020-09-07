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

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movie/page/{page?}', 'MoviesController@index');
Route::get('/movie/{movie}', 'MoviesController@show')->name('movies.show');


Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{actor}', 'ActorsController@show')->name('actors.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/page/{page?}', 'TvController@index');
Route::get('/tv/{tv}', 'TvController@show')->name('tv.show');