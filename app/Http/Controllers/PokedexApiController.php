<?php

namespace App\Http\Controllers;
use PokePHP\PokeApi;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use App\Models\Team;
use App\Models\TeamPokemon;

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
        return PokemonResource::collection(Pokemon::skip(10)->take(20)->paginate(5));
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

    public function create_team(Request $request) {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        $team = new Team();
        $team->name = $request->name;
        $result = $team->save();

        if ($result) {
            return response()->json([
                'id' => $team->id,
                'name' => $team->name,
                'pokemons' => $team->pokemon
            ], 201);

        return response()->json([
            'result' => 'Operation failed'
        ], 500);
        }
    }

    public function set_pokemon_for_team(Team $id, Request $request) {
        $request->validate([
            'pokemons' => ['required', 'array', 'min:1', 'max:6']
        ]);

        $test = DB::table('team_pokemon')->where('team_id', $id->id)->delete(); 

        foreach($request->pokemons as $pokemon) {
            TeamPokemon::create([
                'team_id' => $id->id,
                'pokemon_id' => $pokemon
            ]);
        }
    }
}