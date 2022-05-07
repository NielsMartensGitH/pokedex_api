<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonStatType extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id', 'stat_type_id', 'base_stat', 'effort'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
