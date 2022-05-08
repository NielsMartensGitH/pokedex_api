<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use App\Http\Resources\PokemonResource;

class PokedexApiController extends Controller
{
    public function pokemons() {

        return PokemonResource::collection(Pokemon::all());
    }

    public function pokemon_detail(Pokemon $id) {
        return new PokemonResource($id);
    }
}
