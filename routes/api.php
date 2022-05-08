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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::get('pokemons', [PokedexApiController::class, 'pokemons']);
    Route::get('pokemons/{id}', [PokedexApiController::class, 'pokemon_detail']);
    Route::get('teams', [PokedexApiController::class, 'teams']);
    Route::get('teams/{id}', [PokedexApiController::class, 'single_team']);
    Route::get('search', [PokedexApiController::class, 'search_pokemon_by_name_or_type']);
});

Route::prefix('v2')->group(function() {
    Route::get('pokemons', [PokedexApiController::class, 'pokemons_paginated']);
});