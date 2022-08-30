<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Route::get('/champReg', 'ChampionRegisterController@index');
Route::post('/champReg', 'ChampionRegisterController@store');

Route::get('/scoreReg/{id}', 'MatchScoreRegisterController@getMatches');
Route::post('/scoreReg', 'MatchScoreRegisterController@store');

Route::get('/toplists/{id}', 'ChampionToplistController@listToplists');
