<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TorneoController;
use \App\Http\Controllers\RondaController;
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
    Route::resource('torneos', TorneoController::class);
    Route::resources([
        'users' => \App\Http\Controllers\UserController::class
    ]);    Route::resource('rondas', RondaController::class);
    Route::resource('torneoJugador', \App\Models\TorneoJugador::class);
});


Route::post('/user', [\App\Http\Controllers\UserController::class, 'store']);

//Torneo
Route::get('/torneos', [TorneoController::class, 'index']);
Route::get('/torneos/{id}', [TorneoController::class, 'show']);
Route::get('/torneos', [TorneoController::class, 'index']);
Route::post('/torneos', [TorneoController::class, 'store']);
Route::put('/torneos/{id}', [TorneoController::class, 'update']);
Route::delete('/torneos', [TorneoController::class, 'destroy']);
