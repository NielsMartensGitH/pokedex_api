<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function pokemon() {
        return $this->HasManyThrough(Pokemon::class, PokemonType::class, 'type_id', 'id', 'id', 'pokemon_id');
    }
}