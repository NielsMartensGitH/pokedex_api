<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprite extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id', 'sprite_category_id', 'image_path'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'id', 'pokemon_id', 'sprite_category_id'
    ];
}
