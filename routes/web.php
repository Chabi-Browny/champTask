<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChampionRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchScoreRegisterController;
use App\Http\Controllers\ChampionToplistController;
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
Route::get('/', [HomeController::class, 'index']);

Route::get('/champReg', [ChampionRegisterController::class, 'index']);
Route::post('/champReg', [ChampionRegisterController::class, 'store']);

Route::get('/scoreReg/{id}', [MatchScoreRegisterController::class, 'getMatches']);
Route::post('/scoreReg', [MatchScoreRegisterController::class, 'store']);

Route::get('/toplists/{id}', [ChampionToplistController::class, 'listToplists' ]);

//Route::get('/', 'HomeController@index');

//Route::get('/champReg', 'ChampionRegisterController@index');
//Route::post('/champReg', 'ChampionRegisterController@store');
//
//Route::get('/scoreReg/{id}', 'MatchScoreRegisterController@getMatches');
//Route::post('/scoreReg', 'MatchScoreRegisterController@store');
//
//Route::get('/toplists/{id}', 'ChampionToplistController@listToplists');
