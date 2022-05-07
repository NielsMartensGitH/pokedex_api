<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function pokemon() {
        return $this->HasManyThrough(Pokemon::class, TeamPokemon::class, 'team_id', 'id', 'id', 'pokemon_id');
    }
}
