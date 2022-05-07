<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveLearnMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function moves() {
        return $this->hasManyThrough(Move::class, MoveVersionGroup::class, 'move_learn_method_id', 'id', 'id', 'move_id');
    }

    public function version_groups() {
        return $this->hasManyThrough(VersionGroup::class, MoveVersionGroup::class, 'move_learn_method_id', 'id', 'id', 'version_group_id');
    }

}
