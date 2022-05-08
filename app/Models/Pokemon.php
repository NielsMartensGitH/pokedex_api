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

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function specie() {
        return $this->belongsTo(Specie::class);
    }

    public function types() {
        return $this->HasManyThrough(Type::class, PokemonType::class, 'pokemon_id', 'id', 'id', 'type_id');
    }

    public function abilities() {
        return $this->HasManyThrough(Ability::class, PokemonAbility::class, 'pokemon_id', 'id', 'id', 'ability_id');
    }

    public function pokemon_abilities() {
        return $this->HasMany(PokemonAbility::class);
    }

    public function teams() {
        return $this->HasManyThrough(Team::class, TeamPokemon::class, 'pokemon_id', 'id', 'id', 'team_id');
    }

    public function stat_types() {
        return $this->HasManyThrough(StatType::class, PokemonStatType::class, 'pokemon_id', 'id', 'id', 'stat_type_id');
    }

    public function pokemon_stats() {
        return $this->HasMany(PokemonStatType::class);
    }


    public function moves() {
        return $this->HasManyThrough(Move::class, PokemonMove::class, 'pokemon_id', 'id', 'id', 'move_id');
    }

    public function sprite_categories() {
        return $this->HasManyThrough(SpriteCategory::class, Sprite::class, 'pokemon_id', 'id', 'id', 'sprite_category_id');
    }

    public function sprites() {
        return $this->HasMany(Sprite::class);
    }

    public function pokemon_types() {
        return $this->HasMany(PokemonType::class);
    }
}
