<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonType extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id', 'type_id', 'slot'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
