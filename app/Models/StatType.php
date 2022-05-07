<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatType extends Model
{
    use HasFactory;

    public function pokemon() {
        return $this->HasManyThrough(Pokemon::class, PokemonStatType::class, 'stat_type_id', 'id', 'id', 'pokemon_id');
    }
}
