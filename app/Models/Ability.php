<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    public function pokemons_abilities() {

        return $this->hasMany(PokemonAbility::class);
    }
}
