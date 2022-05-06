<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    public function pokemons() {
        return $this->hasManyThrough(Ability::class, PokemonAbility::class, 'ability_id', 'id', 'id', 'pokemon_id');
    }
}
