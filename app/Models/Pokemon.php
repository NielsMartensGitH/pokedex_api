<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'height', 'weight', 'order', 'specie_id'
    ];

    public function specie() {
        return $this->belongsTo(Pokemon::class);
    }
}
