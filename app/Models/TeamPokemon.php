<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id', 'pokemon_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
