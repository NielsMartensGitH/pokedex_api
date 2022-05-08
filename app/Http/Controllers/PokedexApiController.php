<?php

namespace App\Http\Controllers;
use PokePHP\PokeApi;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use App\Models\Team;

use App\Http\Resources\PokemonResource;
use App\Http\Resources\TeamResource;

class PokedexApiController extends Controller
{
    public function pokemons() {

        return PokemonResource::collection(Pokemon::all());
    }

    public function pokemon_detail(Pokemon $id) {
        return new PokemonResource($id);
    }

    public function pokemons_paginated(Request $request) {

        $limit = $request->limit;
        $sort = $request->sort;
        return PokemonResource::collection(Pokemon::orderBy('name', 'desc')->paginate($limit));
    }

    public function teams() {

        return TeamResource::collection(Team::all());
    }

    public function single_team(Team $id) {
        return new TeamResource($id);
    }

    public function search_pokemon_by_name_or_type(Request $request) {

        $search_value = $request->get('query');
        return PokemonResource::collection(Pokemon::where("name", "like", "%".$search_value."%")->get());
    }
}