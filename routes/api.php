<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\TorneoController;
use \App\Http\Controllers\RondaController;
use \App\Http\Controllers\PartidaController;
use \App\Http\Controllers\TorneoJugadorController;

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
Route::group(['middleware' => ['auth']], function() {
    //Route::resource('torneos', TorneoController::class);
    //Route::resources([
    //    'users' => \App\Http\Controllers\UserController::class
    //]);    Route::resource('rondas', RondaController::class);
    //Route::resource('torneoJugador', \App\Models\TorneoJugador::class);
});

//User
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

//Torneo
Route::get('/torneos', [TorneoController::class, 'index']);
Route::get('/torneos/{id}', [TorneoController::class, 'show']);
Route::get('/torneos/search/{valor}', [TorneoController::class, 'search']);
Route::post('/torneos', [TorneoController::class, 'store']);
Route::put('/torneos/{id}', [TorneoController::class, 'update']);
Route::delete('/torneos/{id}', [TorneoController::class, 'destroy']);

//Ronda
Route::get('/ronda', [RondaController::class, 'index']);
Route::get('/ronda/{id}', [RondaController::class, 'show']);
Route::post('/ronda', [RondaController::class, 'store']);
Route::put('/ronda/{id}', [RondaController::class, 'update']);
Route::delete('/ronda/{id}', [RondaController::class, 'destroy']);

//Partida
Route::get('/partida', [PartidaController::class, 'index']);
Route::get('/partida/{id}', [PartidaController::class, 'show']);
Route::post('/partida', [PartidaController::class, 'store']);
Route::put('/partida/{id}', [PartidaController::class, 'update']);
Route::delete('/partida/{id}', [PartidaController::class, 'destroy']);

Route::get('/torneojugador', [TorneoJugadorController::class, 'index']);
Route::get('/torneojugador/{id}', [TorneoJugadorController::class, 'show']);
Route::post('/torneojugador', [TorneoJugadorController::class, 'store']);
Route::put('/torneojugador/{id}', [TorneoJugadorController::class, 'update']);
Route::delete('/torneojugador/{id}', [TorneoJugadorController::class, 'destroy']);

