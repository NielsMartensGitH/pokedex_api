<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonMove extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id', 'move_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
