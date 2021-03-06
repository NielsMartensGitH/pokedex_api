<?php

use App\Http\Controllers\PokedexApiController;
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

// Bearer Token required for below endpoints!
Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('v1')->group(function() {
        Route::get('teams', [PokedexApiController::class, 'teams']);
        Route::get('teams/{id}', [PokedexApiController::class, 'single_team'])->missing(function() { 
            return response(['error' => 'Not valid', 'error_message' => 'Cannot find team!'], 404);
        });
        Route::post('teams', [PokedexApiController::class, 'create_team']);
        Route::post('teams/{id}', [PokedexApiController::class, 'set_pokemon_for_team'])->missing(function() { 
            return response(['error' => 'Not valid', 'error_message' => 'Cannot find team!'], 404);
        });
    });

});

// No bearer token required
Route::prefix('v1')->group(function() {
    Route::get('pokemons', [PokedexApiController::class, 'pokemons']);
    Route::get('pokemons/{id}', [PokedexApiController::class, 'pokemon_detail']);
    Route::get('search', [PokedexApiController::class, 'search_pokemon_by_name_or_type']);
});

Route::prefix('v2')->group(function() {
    Route::get('pokemons', [PokedexApiController::class, 'pokemons_paginated']);
});