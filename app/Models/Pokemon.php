<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'height', 'weight', 'order', 'specie_id'
    ];

    public function specie() {
        return $this->belongsTo(Pokemon::class);
    }

    public function types() {
        return $this->HasManyThrough(Type::class, PokemonType::class, 'pokemon_id', 'id', 'id', 'type_id');
    }

    public function abilities() {
        return $this->HasManyThrough(Ability::class, PokemonAbility::class, 'pokemon_id', 'id', 'id', 'ability_id');
    }
}
