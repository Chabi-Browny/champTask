<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChampionRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchScoreRegisterController;
use App\Http\Controllers\ToplistController;
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

Route::get('/championshipToplists', [ToplistController::class, 'championshipToplists' ]);
//Route::get('/crawlToplists/{id}', [ToplistController::class, 'crawlToplists' ]);
