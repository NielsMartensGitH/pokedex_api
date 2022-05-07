<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokedexApiController extends Controller
{
    public function pokemons() {

        $res = Pokemon::with('types', 'types', 'pokemon_types', 'sprites')->get();
        return response()->json($res);
    }
}
