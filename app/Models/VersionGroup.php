<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionGroup extends Model
{
    use HasFactory;

    public function move_learn_methods() {
        return $this->HasManyThrough(MoveLearnMethod::class, MoveVersionGroup::class, 'version_group_id', 'id', 'id', 'move_learn_method_id');
    }

    public function moves() {
        return $this->HasManyThrough(Move::class, MoveVersionGroup::class, 'version_group_id', 'id', 'id', 'move_id');
    }
}
