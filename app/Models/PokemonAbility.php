<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonAbility extends Model
{
    use HasFactory;

    protected $fillable = [
       'pokemon_id', 'ability_id', 'is_hidden', 'slot'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $casts = ['is_hidden' => 'boolean'];

    public function ability() {
        return $this->belongsTo(Ability::class);
    }

    public function pokemon() {
        return $this->belongsTo(Pokemon::class);
    }
}
