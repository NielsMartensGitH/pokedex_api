<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function pokemon() {
        return $this->hasManyThrough(Pokemon::class, PokemonMove::class, 'move_id', 'id', 'id', 'pokemon_id');
    }

    public function move_learn_methods() {
        return $this->HasManyThrough(MoveLearnMethod::class, MoveVersionGroup::class, 'move_id', 'id', 'id', 'move_learn_method_id');
    }

    public function version_groups() {
        return $this->HasManyThrough(VersionGroup::class, MoveVersionGroup::class, 'move_id', 'id', 'id', 'version_group_id');
    }

    public function move_version_groups() {
        return $this->HasMany(MoveVersionGroup::class);
    }
}
