<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'id', 'laravel_through_key'
    ];

    public function pokemon() {
        return $this->HasManyThrough(Pokemon::class, PokemonType::class, 'type_id', 'id', 'id', 'pokemon_id');
    }

    public function pokemon_types() {

        return $this->hasMany(PokemonType::class);
    }
}