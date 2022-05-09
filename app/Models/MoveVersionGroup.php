<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveVersionGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'move_id', 'version_group_id', 'move_learn_method_id', 'level_learned_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}
